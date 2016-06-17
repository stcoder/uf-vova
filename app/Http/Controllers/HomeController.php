<?php namespace App\Http\Controllers;

use App\HistoryDate;
use App\Review;
use App\ScheduleAndCost;
use App\Slide;
use Illuminate\View\View;
use Request;
use App\Post;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * @return View
	 */
	public function index()
	{
		$posts = $this->__getPosts();
		$review = $this->__getReview();
		$data = [
			'posts' => $posts,
			'review' => $review,
			'slides' => Slide::orderBy('sort', 'asc')->get(),
			'histories' => HistoryDate::orderBy('order', 'asc')->get(),
			'schedule_and_cost' => ScheduleAndCost::orderBy('order', 'asc')->get(),
			'next_posts' => $posts->nextPageUrl()
		];

		return view('welcome', $data);
	}

	/**
	 * @return \Illuminate\Contracts\Pagination\Paginator
	 */
	protected function __getPosts()
	{
		$posts = Post::withTrashed()->orderBy('date', 'DESC')->simplePaginate(8);
		$posts->setPath(route('load_next_posts'));

		return $posts;
	}

	/**
	 * Возвращает объект отзыва или пустой результат.
	 *
	 * Запоминает в сессии 10 последних отзывов.
	 * Отзыв выбирается из базы рандомно исключая отзывы из сессии.
	 *
	 * @return Review|null
	 */
	protected function __getReview()
	{
		$review_ids = Request::session()->get('review_ids');

		$where = Review::withTrashed()->with('profile');

		if (!is_null($review_ids)) {
			$where->whereNotIn('id', $review_ids);
		}

		$where->orderByRaw('RAND()');
		$where->limit(1);

		$reviews = $where->get();
		$review = null;

		if ($reviews) {
			$review = $reviews[0];
		}

		if (is_null($review_ids)) {
			$review_ids = [];
		}

		if (sizeof($review_ids) >= 30) {
			$review_ids = array_slice($review_ids, 1);
		}

		if (sizeof($review_ids) < 30) {
			array_push($review_ids, $review->id);
		}

		Request::session()->set('review_ids', $review_ids);

		return $review;
	}

	/**
	 * Method Action
	 *
	 * @return \Response
	 */
	public function loadReview()
	{
		if (!Request::ajax()) {
			abort(404);
		}

		$review = $this->__getReview();
		$response_data = ['no' => true];

		if (!is_null($review)) {
			$response_data = [
				'text_small' => str_limit($review->text, 400),
				'text_full' => $review->text,
				'text_isBig' => strlen($review->text) > 400,
				'profile_name' => $review->profile->first_name . ' ' . $review->profile->last_name,
				'profile_domain' => $review->profile->domain,
				'profile_photo' => $review->profile->photo
			];
		}

		return response()->json($response_data);
	}

	/**
	 * Method Action
	 *
	 * @return \Response
	 */
	public function loadNextPosts()
	{
		if (!Request::ajax()) {
			abort(404);
		}

		$posts = $this->__getPosts();
		$items = [];
		foreach($posts as $key => $post) {
			$items[] = view('post.item', ['post' => $post])->render();
		}

		return response()->json(['items' => $items, 'type' => 'posts', 'next_url' => $posts->nextPageUrl()]);
	}

}
