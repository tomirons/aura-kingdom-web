<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Initiate middleware
     */
    public function __construct()
    {
        $this->middleware('role:admin|mod');

        $this->middleware('permission:manage-articles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        pagetitle( [ trans( 'news.index' ), settings( 'server_name' ) ] );
        $articles = Article::paginate();
        return view( 'admin.news.view', compact( 'articles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        pagetitle( [ trans( 'news.create' ), settings( 'server_name' ) ] );
        return view( 'admin.news.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( ArticleRequest $request )
    {
        Article::create( $request->all() );

        flash()->success( trans( 'news.create_success' ) );

        return redirect( 'admin/news' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $news
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit( Article $news )
    {
        pagetitle( [ trans( 'news.edit', ['title' => $news->title] ), settings( 'server_name' ) ] );
        return view( 'admin.news.edit', compact( 'news' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @param Article $news
     * @return \Illuminate\Http\Response
     */
    public function update( ArticleRequest $request, Article $news )
    {
        $news->update( $request->all() );

        flash()->success( trans( 'news.edit_success' ) );

        return redirect( 'admin/news' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Article $news
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy( Request $request, Article $news )
    {
        if ( $request->ajax() )
        {
            $news->delete();
        }
    }
}
