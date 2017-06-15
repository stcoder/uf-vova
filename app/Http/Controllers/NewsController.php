<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;

use Illuminate\Http\Request;

class NewsController extends Controller {

    public function dashboard() {
        $news = News::where('published', true)->orderBy('published_at', 'DESC')->paginate(5);
        $news->setPath(route('news.dashboard'));

        return view('news.dashboard', ['news_list' => $news]);
    }

    public function detail($date, \App\News $news) {
        if (!$news->isPublished() || $news->trashed()) {
            abort(404);
        }

        $data = [
            'news' => $news
        ];

        return view('news.detail', $data);
    }
}