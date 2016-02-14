<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
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
     * Get weather or not the user has administrative privileges
     *
     * @return bool
     */
    public function is_admin()
    {
        return ( $this->role === 'administrator' ) ? TRUE : FALSE;
    }

    /**
     * Get account balance
     *
     * @return string
     */
    public function balance()
    {
        return number_format( DB::connection( 'member' )->table( 'tb_user' )->where( 'mid', $this->username )->first()->pvalues );
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
