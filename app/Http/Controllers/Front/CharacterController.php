<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    /**
     * Assign middleware
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Set the character for the user
     *
     * @param $player_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getIndex( $player_id )
    {
        $character_info = DB::connection( 'game' )->table( 'player_characters' )->where( 'id', $player_id )->first();
        session()->put( 'character', $character_info );
        return redirect()->back();
    }
}
