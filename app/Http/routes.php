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

    /* Character */
    Route::get( 'character/select/{role_id}', 'Front\CharacterController@getIndex' );

    /* Language */
    Route::get( 'language/{lang}', 'LanguageController@index' );

    /* Auth */
    Route::get( 'login', 'Front\AuthController@getLogin' );
    Route::post( 'login', 'Front\AuthController@postLogin' );
    Route::get( 'logout', 'Front\AuthController@logout' );
    Route::post( 'register', 'Front\AuthController@postRegister' );

    /* News */
    Route::get( '/', ['as' => 'news.index', 'uses' => 'Front\NewsController@getIndex'] );

    /* Donate */
    Route::get( 'donate', ['as' => 'donate.index', 'uses' => 'Front\DonateController@getIndex'] );
    Route::post( 'donate/paypal', 'Front\DonateController@postPayPalSubmit' );
    Route::get( 'donate/paypal/complete', 'Front\DonateController@postPayPalComplete' );
    Route::post( 'donate/paymentwall', 'Front\DonateController@postPaymentwall' );

    /* Vote */
    Route::get( 'vote', ['as' => 'vote.index', 'uses' => 'Front\VoteController@getIndex'] );
    Route::get( 'vote/success/{site}', ['as' => 'vote.success', 'uses' => 'Front\VoteController@getSuccess'] );
    Route::post( 'vote/check/{site}', 'Front\VoteController@postCheck' );

});
