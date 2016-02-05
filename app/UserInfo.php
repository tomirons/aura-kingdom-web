<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'member';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_user';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'mid';
}
