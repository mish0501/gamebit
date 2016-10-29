<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\FriendRequestNotification;

class FriendshipController extends Controller
{
    public function searchFriend(Reuest $request)
    {
      $validator = Validator::make($request->all(), [
           'name' => 'required|exists:user,username',
       ]);

       if ($validator->fails()) {
           return $validator->errors();
       }

       $this->requestFriend($request->first('username'));
    }

    public function requestFriend($friend)
    {
      $user = \Auth::user();

      $friend = User::where('username', $friend)->first();

      $user->befriend($friend);

      $friend->notify(new FriendRequestNotification($user));
    }
}
