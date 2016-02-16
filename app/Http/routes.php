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

Route::group(['middleware' => ['web', 'language']], function () {

    /* Character */
    Route::get( 'character/select/{role_id}', 'Front\CharacterController@getIndex' );

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

    /* Ranking */
    Route::get( 'ranking', 'Front\RankingController@getIndex' );
    Route::get( 'ranking/player/{sub}', ['as' => 'ranking.index', 'uses' => 'Front\RankingController@getPlayer'] );
    Route::get( 'ranking/family', function(){
        return redirect( 'ranking/family/level' );
    });
    Route::get( 'ranking/family/{sub}', ['as' => 'ranking.index', 'uses' => 'Front\RankingController@getFamily'] );

    /* Admin */
    Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'admin'] ], function() {

        Route::get( '/', ['as' => 'admin.index', 'uses' => 'Admin\DashboardController@getIndex'] );

        /* System */
        Route::group( ['prefix' => 'system', 'as' => 'admin.system.'], function() {

            Route::get( 'settings', ['as' => 'settings', 'uses' => 'Admin\SystemController@getSettings'] );
            Route::post( 'settings', 'Admin\SystemController@postSettings' );
            Route::get( 'apps', ['as' => 'apps', 'uses' => 'Admin\SystemController@getApps'] );
            Route::post( 'apps', 'Admin\SystemController@postApps' );

        });

        /* Members */
        Route::get( 'members/manage', ['as' => 'admin.members.manage', 'uses' => 'Admin\MembersController@getManage'] );
        Route::post( 'members/balance/{user}', 'Admin\MembersController@postBalance' );
        Route::post( 'members/search', 'Admin\MembersController@postSearch' );

        /* News */
        Route::get( 'news/settings', ['as' => 'admin.news.settings', 'uses' => 'Admin\NewsController@getSettings'] );
        Route::post( 'news/settings', 'Admin\NewsController@postSettings' );
        Route::resource( 'news', 'Admin\NewsController' );

        /* Donate */
        Route::get( 'donate/settings', ['as' => 'admin.donate.settings', 'uses' => 'Admin\DonateController@getSettings'] );
        Route::post( 'donate/paypal', 'Admin\DonateController@postPaypalSettings' );
        Route::post( 'donate/paymentwall', 'Admin\DonateController@postPaymentwallSettings' );

        /* Vote */
        Route::resource( 'vote', 'Admin\VoteController' );

    });
});
