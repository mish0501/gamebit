<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Notifications\FriendRequestNotification;

class FriendshipController extends Controller
{
    public function searchFriend(Request $request)
    {
       $validator = Validator::make($request->all(), [
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

      if ($user->isFriendWith($friend)) {
        return response()->json([
          'username' => ['You are already friends.'],
        ]);
      }

      if ($user->hasSentFriendRequestTo($friend)){
        return response()->json([
          'username' => ['You alredy sent friend request to this person.'],
        ]);
      }

      if ($friend->hasSentFriendRequestTo($user)){
        return response()->json([
          'username' => ['This user has already sent you a friend request. Check your notifications.'],
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

      $friends = $user->getFriends();

      return $friends;
    }

    public function getFriendRequests()
    {
      $user = Auth::user();

      $requests = $user->getFriendRequestUsers();

      return $requests;
    }

    public function acceptFriendRequest(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'id' => 'required|exists:users',
          'notification_id' => 'required|exists:notifications,id'
      ]);

      if ($validator->fails()) {
          return $validator->errors();
      }

      $user = Auth::user();
      $friend = User::find($request->get('id'));

      $user->acceptFriendRequest($friend);

      $notification = $user->notifications()->where('id', $request->get('notification_id'))->first();
      if($notification){
        $notification->delete();
      }

      return response()->json([
        'done' => true,
      ]);
    }

    public function denyFriendRequest(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'id' => 'required|exists:users',
          'notification_id' => 'required|exists:notifications,id'
      ]);

      if ($validator->fails()) {
          return $validator->errors();
      }

      $user = Auth::user();
      $friend = User::find($request->get('id'));

      $user->denyFriendRequest($friend);

      $notification = $user->notifications()->where('id', $request->get('notification_id'))->first();
      if($notification){
        $notification->delete();
      }

      return response()->json([
        'done' => true,
      ]);
    }
}
