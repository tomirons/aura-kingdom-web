<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'account';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the users password
     *
     * @return mixed
     */
    public function getAuthPassword()
    {
        $result = DB::connection('member')->table('tb_user')->where('mid' , $this->username)->first();
        return $result->pwd;
    }

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
        return number_format( $this->money, 2 );
    }
}
