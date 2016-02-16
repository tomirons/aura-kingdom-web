<?php

namespace App\Http\Controllers\Front;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display the news articles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        pagetitle( [ trans( 'main.apps.news' ), settings( 'server_name' ) ] );
        $articles = Article::orderBy( 'created_at', 'desc' )->paginate();
        return view( 'front.news.index', compact( 'articles' ) );
    }
}
