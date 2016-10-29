<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auth;
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
      $user = Auth::user();

      $friend = User::where('username', $friend)->first();

      $user->befriend($friend);

      $friend->notify(new FriendRequestNotification($user));
    }

    public function getAllFriends()
    {
      $user = Auth::user();

      $friends = $user->getAllFriendships();

      return $friends;
    }

    public function acceptFriendRequest(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'id' => 'required|exists:user',
      ]);

      if ($validator->fails()) {
          return $validator->errors();
      }

      $user = Auth::user();
      $friend = User::find($request->get('id'));

      $user->acceptFriendRequest($friend);

      return true;
    }

    public function denyFriendRequest(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'id' => 'required|exists:user',
      ]);

      if ($validator->fails()) {
          return $validator->errors();
      }
      
      $user = Auth::user();
      $friend = User::find($request->get('id'));

      $user->denyFriendRequest($friend);

      return true;
    }
}
