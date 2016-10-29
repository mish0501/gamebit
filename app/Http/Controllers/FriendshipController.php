<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Notifications\FriendRequestNotification;

class FriendshipController extends Controller
{
    public function searchFriend(Request $request)
    {
       $validator = \Validator::make($request->all(), [
           'username' => 'required|exists:users,username',
       ]);

       if ($validator->fails()) {
           return $validator->errors();
       }

       return $this->requestFriend($request->get('username'));
    }

    public function requestFriend($friend)
    {
      $user = Auth::user();

      $friend = User::where('username', $friend)->first();

      if($user->id == $friend->id){
        return response()->json([
          'username' => ['You can not sent friend invitation to yourself.'],
        ]);
      }

      if ($user->hasSentFriendRequestTo($friend)){
        return response()->json([
          'username' => ['You alredy sent friend request to this person.'],
        ]);
      }

      $user->befriend($friend);

      $friend->notify(new FriendRequestNotification($user));

      return response()->json([
        'success' => 'Friend request sent.',
      ]);
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
