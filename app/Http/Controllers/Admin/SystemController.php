<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    /**
     * Allow the user to enable/disable applications
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getApps()
    {
        pagetitle( [ trans( 'system.apps' ), trans( 'main.apps.system' ), settings( 'server_name' ) ] );
        $apps = Application::all();
        return view( 'admin.system.apps', compact( 'apps' ) );
    }

    /**
     * Save the application settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postApps( Request $request )
    {
        $apps = Application::all();

        foreach ( $apps as $app )
        {
            $app->enabled = $request->{$app->key . '_enabled'};
            $app->save();
        }

        flash()->success( trans( 'system.apps_edit_success' ) );

        return redirect()->back();
    }

    /**
     * Show the System Settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettings()
    {
        pagetitle( [ trans( 'system.panel' ), trans( 'main.apps.system' ), settings( 'server_name' ) ] );
        return view( 'admin.system.settings' );
    }

    /**
     * Save the settings in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings( Request $request )
    {
        $this->validate($request, [
            'server_name' => 'required|min:5'
        ]);

        Settings::set( 'server_name', $request->server_name );

        flash()->success( trans( 'system.success' ) );

        return redirect()->back();
    }
}
