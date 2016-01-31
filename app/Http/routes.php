<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    /* Language */
    Route::get( 'language/{lang}', 'LanguageController@index' );
    /* Auth */
    Route::get( 'login', 'Front\AuthController@getLogin' );
    Route::post( 'login', 'Front\AuthController@postLogin' );
    Route::get( 'logout', 'Front\AuthController@logout' );
    Route::post( 'register', 'Front\AuthController@postRegister' );

    /* News */
    Route::get( '/', ['as' => 'news.index', 'uses' => 'Front\NewsController@getIndex'] );
});
