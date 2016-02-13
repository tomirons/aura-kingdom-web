<?php

namespace App\Http\Controllers\Front;

use App\Family;
use App\Player;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    /**
     * List of possible types to search by
     *
     * @var array
     */
    protected $types = [ 'level', 'gold', 'pvp' ];

    /**
     * Redirect to player level rankings
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getIndex()
    {
        /*
         * We want to automatically redirect the user to the player/level page
         * so we don't have to retrieve the variables twice.
         */
        return redirect( 'ranking/player/level' );
    }

    /**
     * Get player rankings based on type
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPlayer( Request $request )
    {
        pagetitle( [ trans( 'ranking.player' ) . ' ' . trans( 'main.apps.ranking' ), settings( 'server_name' ) ] );

        $players = Player::type( $request->segment( 3 ) )->paginate();

        return view( 'front.ranking.player', compact( 'players' ) );
    }

    /**
     * Get family rankings based on type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFamily( Request $request )
    {
        pagetitle( [ trans( 'ranking.player' ) . ' ' . trans( 'main.apps.ranking' ), settings( 'server_name' ) ] );

        $families = Family::type( $request->segment( 3 ) )->paginate();

        return view( 'front.ranking.family', compact( 'families' ) );
    }
}
