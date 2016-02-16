<?php

namespace App\Providers;

use App\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer( ['front.header', 'admin.header'], function( $view ) {
            $languages = [];
            $folders = File::directories( base_path( 'resources/lang/' ) );
            foreach ( $folders as $folder )
            {
                $languages[] = str_replace( '\\', '', last( explode( '/', $folder ) ) );
            }
            $view->with( 'languages', $languages );
        });

        view()->composer( 'front.header', function ( $view ) {
            $apps = Application::all();
            $view->with( 'apps', $apps );
        });

        view()->composer( 'admin.news.form', function ( $view ) {
            $categories = [
                'update' => trans( 'news.category.update' ),
                'maintenance' => trans( 'news.category.maintenance' ),
                'event' => trans( 'news.category.event' ),
                'contest' => trans( 'news.category.contest' ),
                'other' => trans( 'news.category.other' )
            ];
            $view->with( 'categories', $categories );
        });

        view()->composer( 'front.widgets', function( $view ) {
            $client_status = @fsockopen( settings( 'server_ip', '127.0.0.1' ), 6543, $errCode, $errStr, 1 ) ? TRUE : FALSE;
            $worlds = DB::connection('account')->table('worlds')->get();
            $view->with( 'client_status', $client_status )->with( 'worlds', $worlds );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
