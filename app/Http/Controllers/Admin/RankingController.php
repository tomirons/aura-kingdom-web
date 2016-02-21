<?php

namespace App\Http\Controllers\Admin;

use Efriandika\LaravelSettings\Facades\Settings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    /**
     * Show the ranking settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettings()
    {
        pagetitle( [ trans( 'main.settings' ), trans( 'main.apps.ranking' ), settings( 'server_name' ) ] );
        return view( 'admin.ranking.settings' );
    }

    /**
     * Save the settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postSettings(Request $request )
    {
        Settings::set( 'ranking_ignore_characters', $request->ranking_ignore_roles );

        Settings::set( 'ranking_ignore_families', $request->ranking_ignore_factions );

        flash()->success( trans( 'main.settings_saved' ) );

        return redirect( 'admin/ranking/settings' );
    }
}
