<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'username', 'password' ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get account balance
     *
     * @return string
     */
    public function balance()
    {
        $member = DB::connection( 'member' )->table( 'tb_user' )->where( 'mid', $this->username );
        return ( $member->exists() ) ? number_format( $member->first()->pvalues ) : 0;
    }

    /**
     * Get weather or not the user has selected a character
     *
     * @return mixed
     */
    public function characterSelected()
    {
        return session()->has( 'character' );
    }

    /**
     * Get the users character list
     *
     * @return mixed
     */
    public function characters()
    {
        return DB::connection( 'game' )->table( 'player_characters' )->where( 'account_name', $this->username )->get();
    }

    /**
     * Get the current selected character information
     *
     * @return mixed
     */
    public function character()
    {
        return session()->get( 'character' );
    }
}
