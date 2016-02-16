<?php

namespace App\Http\Controllers\Admin;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * GitHub Manager
     *
     * @var GitHubManager
     */
    protected $github;

    /**
     * Initiate the manager
     *
     * @param GitHubManager $github
     */
    public function __construct( GitHubManager $github )
    {
        $this->github = $github;
    }

    /**
     * Show the dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        pagetitle( [ trans( 'main.dashboard' ), settings( 'server_name' ) ] );
        $online_players = 0;
        foreach ( DB::connection( 'account' )->table( 'worlds' )->get() as $world )
        {
            $online_players += $world->online_user;
        }
        $releases = $this->github->api( 'repo' )->releases()->all( 'huludini', 'aura-kingdom-web' );
        return view( 'admin.index', compact( 'online_players', 'releases' ) );
    }
}
