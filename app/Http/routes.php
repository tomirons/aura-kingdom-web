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

    /* Account Settings */
    Route::get( 'account/settings', ['as' => 'account.settings', 'uses' => 'Front\AccountController@getSettings'] );
    Route::post( 'account/settings/password', 'Front\AccountController@postPassword' );

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
    Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'staff'] ], function() {

        Route::get( '/', ['as' => 'admin.index', 'uses' => 'Admin\DashboardController@getIndex'] );

        /* System */
        Route::group( ['prefix' => 'system', 'as' => 'admin.system.', 'middleware' => ['role:admin|mod', 'permission:manage-system']], function() {

            Route::get( 'settings', ['as' => 'settings', 'uses' => 'Admin\SystemController@getSettings'] );
            Route::post( 'settings', 'Admin\SystemController@postSettings' );
            Route::get( 'apps', ['as' => 'apps', 'uses' => 'Admin\SystemController@getApps'] );
            Route::post( 'apps', 'Admin\SystemController@postApps' );

        });

        /* Members */
        Route::group( ['prefix' => 'members', 'as' => 'admin.members.', 'middleware' => ['role:admin|mod', 'permission:manage-users']], function() {

            Route::get( 'manage', ['as' => 'manage', 'uses' => 'Admin\MembersController@getManage'] );
            Route::post( 'balance/{user}', 'Admin\MembersController@postBalance' );
            Route::post( 'search', 'Admin\MembersController@postSearch' );

        });

        /* News */
        Route::resource( 'news', 'Admin\NewsController' );

        /* Donate */
        Route::group( ['prefix' => 'donate', 'as' => 'admin.donate.', 'middleware' => ['role:admin|mod', 'permission:change-donate-settings']], function() {

            Route::get( 'settings', ['as' => 'settings', 'uses' => 'Admin\DonateController@getSettings'] );
            Route::post( 'paypal', 'Admin\DonateController@postPaypalSettings' );
            Route::post( 'paymentwall', 'Admin\DonateController@postPaymentwallSettings' );

        });

        /* Vote */
        Route::resource( 'vote', 'Admin\VoteController' );

    });

    /* Installer */
    Route::group( ['prefix' => 'admin/install', 'as' => 'admin.installer.'], function()
    {
        Route::group( ['middleware' => 'installed'], function()
        {
            Route::get( '/', [
                'as' => 'welcome',
                'uses' => 'Admin\InstallController@welcome'
            ]);

            Route::get( 'requirements', [
                'as' => 'requirements',
                'uses' => 'Admin\InstallController@requirements'
            ]);

            Route::get( 'settings', [
                'as' => 'settings',
                'uses' => 'Admin\InstallController@getSettings'
            ]);

            Route::post( 'setup', [
                'as' => 'settings.save',
                'uses' => 'Admin\InstallController@postSettings'
            ]);

            Route::get( 'complete', [
                'as' => 'complete',
                'uses' => 'Admin\InstallController@complete'
            ]);
        });
    });
});
