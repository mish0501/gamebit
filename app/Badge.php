<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar_id_reward', 'bits_reward', 'description', 'name', 'pic'
    ];

    public function avatar()
    {
        return $this->hasOne('App\Avatar', 'avatar_id_reward');
    }

}
