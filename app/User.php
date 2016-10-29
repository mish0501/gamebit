<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hootlex\Friendships\Traits\Friendable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $profile = new Profile();
            $user->profile()->save($profile);
        });
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function avatars()
    {
        return $this->belongsToMany('App\Avatar');
    }

    public function getFriendRequestUsers()
    {
        $requests = $this->getFriendRequests();
        $requestUsers = [];

        foreach ($requests as $k => $request) {
            $user = User::find($request->sender_id);

            if ($user->hasSentFriendRequestTo($this)) {
                array_push($requestUsers, $user);
            }
        }

        return $requestUsers;
    }
}
