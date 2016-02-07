<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteLog extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'ip_address', 'reward', 'site_id'];

    /**
     * @param $query
     * @param Request $request
     * @param VoteSite $site
     * @return mixed
     */
    public function scopeRecent($query, Request $request, VoteSite $site )
    {
        return $query
            ->where( 'site_id', $site->id )
            ->where( 'user_id', Auth::user()->id )
            ->where( 'ip_address', $request->ip() )
            ->where( 'created_at', '>=', Carbon::now()->subHours( $site->hour_limit ) );
    }

    public function scopeOnCooldown( $query, Request $request, $id )
    {
        return $query
            ->where( 'ip_address', $request->ip() )
            ->where( 'site_id', $id )
            ->orderBy( 'created_at', 'desc' )
            ->take( 1 );
    }
}
