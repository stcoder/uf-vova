<?php namespace App\Http\Controllers;

use Request;
use App\Post;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = $this->__getPosts();
		$data = [
			'posts' => $posts,
			'next_posts' => $posts->nextPageUrl()
		];

		return view('welcome', $data);
	}

	protected function __getPosts()
	{
		$posts = Post::where('deleted_at', '=', null)->orderBy('date', 'DESC')->simplePaginate(6);
		$posts->setPath(route('load_next_posts'));

		return $posts;
	}

	public function loadNextPosts()
	{
		if (!Request::ajax()) {
			abort(404);
		}

		$posts = $this->__getPosts();
		$items = [
			'col-1' => [],
			'col-2' => [],
			'col-3' => []
		];
		foreach($posts as $key => $post) {
			$n = null;
			switch($key) {
				case 0:
				case 3:
					$n = 1;
					break;
				case 1:
				case 4:
					$n = 2;
					break;
				case 2:
				case 5:
					$n = 3;
					break;
			}
			$items['col-' . $n][] = view('post.item', ['post' => $post])->render();
		}

		return response()->json(['items' => $items, 'type' => 'posts', 'next_url' => $posts->nextPageUrl()]);
	}

}
