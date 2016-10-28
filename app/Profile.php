<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bits', 'profile_pic', 'user_id', 'xp'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
