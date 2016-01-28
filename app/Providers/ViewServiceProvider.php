<?php

namespace App\Providers;

use App\Application;
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
