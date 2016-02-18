<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VoteSiteRequest;
use App\VoteSite;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{

    /**
     * Initiate middleware
     */
    public function __construct()
    {
        $this->middleware('role:admin|mod');

        $this->middleware('permission:manage-vote-sites');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        pagetitle( [ trans( 'vote.index' ), settings( 'server_name' ) ] );
        $sites = VoteSite::paginate();
        return view( 'admin.vote.view', compact( 'sites' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        pagetitle( [ trans( 'vote.create' ), settings( 'server_name' ) ] );
        return view( 'admin.vote.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VoteSiteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store( VoteSiteRequest $request )
    {
        VoteSite::create( $request->all() );

        flash()->success( trans( 'vote.create_success' ) );

        return redirect( 'admin/vote' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VoteSite $vote
     * @return \Illuminate\Http\Response
     */
    public function edit( VoteSite $vote )
    {
        pagetitle( [ trans( 'vote.edit', ['name' => $vote->name] ), settings( 'server_name' ) ] );
        return view( 'admin.vote.edit', compact( 'vote' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VoteSiteRequest $request
     * @param VoteSite $vote
     * @return \Illuminate\Http\Response
     */
    public function update( VoteSiteRequest $request, VoteSite $vote )
    {
        $vote->update( $request->all() );

        flash()->success( trans( 'vote.edit_success' ) );

        return redirect( 'admin/vote' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param VoteSite $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, VoteSite $vote )
    {
        if ( $request->ajax() )
        {
            $vote->delete();
        }
    }
}
