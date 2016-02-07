<?php

namespace App\Http\Controllers\Front;

use App\UserInfo;
use App\VoteLog;
use App\VoteSite;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Assign middleware
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    public function getIndex( Request $request )
    {
        pagetitle( [ trans( 'main.apps.vote' ), settings( 'server_name' ) ] );

        $vote_info = [];
        $sites = VoteSite::all();

        foreach ( $sites as $site )
        {
            $log = VoteLog::onCooldown( $request, $site->id );

            if ( $log->exists() )
            {
                $log = $log->first();
                if ( time() < ( $log->created_at->getTimestamp() + ( 3600 * $site->hour_limit ) ) )
                {
                    $vote_info[ $site->id ]['end_time'] = $log->created_at->addHours( $site->hour_limit )->getTimestamp() - Carbon::now()->getTimestamp();
                    $vote_info[ $site->id ]['status'] = FALSE;
                }
                else
                {
                    $vote_info[ $site->id ]['status'] = TRUE;
                }
            }
            else
            {
                $vote_info[ $site->id ]['status'] = TRUE;
            }
        }
        return view( 'front.vote.index', compact( 'sites', 'vote_info' ) );
    }

    public function getSuccess( VoteSite $site )
    {
        pagetitle( [ trans( 'vote.success.title' ), trans( 'main.apps.vote' ), settings( 'server_name' ) ] );
        return view( 'front.vote.success', compact( 'site' ) );
    }

    public function postCheck( Request $request, VoteSite $site )
    {
        if ( !VoteLog::recent( $request, $site )->exists() )
        {
            $user = UserInfo::find( Auth::user()->username );
            $user->pvalues = ( $site->double_rewards ) ? ( $site->reward_amount * 2 ) : $site->reward_amount + $user->pvalues;
            $user->save();

            VoteLog::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'reward' => ( $site->double_rewards ) ? ( $site->reward_amount * 2 ) : $site->reward_amount,
                'site_id' => $site->id
            ]);
            return redirect( 'vote/success/' . $site->id );
        }
        else
        {
            flash()->error( trans( 'vote.already_voted' ) );
            return redirect()->back();
        }
    }
}
