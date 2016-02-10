<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

    /**
     * @param \App\Page $page
     */
	public function showPage(\App\Page $page) {
        if (!$page->isPublished()) {
            abort(404);
        }

        return view('page', [
            'page_title' => $page->title,
            'page_content' => $page->content
        ]);
    }

}
