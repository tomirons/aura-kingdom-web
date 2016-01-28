<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    public $dates = [ 'created_at', 'updated_at' ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [ 'title', 'content', 'category' ];

    /**
     * Get the ribbon color for the panel
     *
     * @param $type
     * @return mixed
     */
    public function color($type )
    {
        $colors = [
            'update' => 'primary',
            'maintenance' => 'danger',
            'event' => 'success',
            'contest' => 'warning',
            'other' => 'default'
        ];
        return $colors[$type];
    }
}
