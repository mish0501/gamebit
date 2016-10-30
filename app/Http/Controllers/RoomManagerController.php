<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\GameRooms;
use App\GameRoomsParticipants;

use App\Events\UserJoinRoom;
use App\Notifications\InviteFriendNotification;
use App\Notifications\DenyInviteNotification;

class RoomManagerController extends Controller
{
  public function createRoom(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'game_id' => 'required|exists:games,id',
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    $room = GameRooms::create([
      'room_code' => $this->generateCode(),
      'game_id' => $game_id,
    ]);

    return $room;
  }

  public function generateCode()
  {
    $digits = 5;
    $code = rand(pow(10, $digits-1), pow(10, $digits)-1);

    $room = GameRooms::where('room_code', $code)->count();

    if($room !== 0){
      $this->generateCode();
    }else{
      return $code;
    }
  }

  public function joinRoom(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'room_code' => 'required|exists:game_rooms',
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    // TODO
    // if ($request->has('name')) {
    //   $name = $request->get('name');
    //
    //   $user = App\User::create([
    //     'name' => $name,
    //     'email' => null,
    //     'username' => null,
    //     'password' => null,
    //   ]);
    //
    //   \Auth::login($user);
    // }


    $user_id = \Auth::user()->id;
    $room = GameRooms::where('room_code', $room_code)->first();

    $room_id = $room->id;
    $room_limit = $room->limit;

    $limit = GameRoomsParticipants::find($room_id)->count();

    if($room_limit >= $limit){
      $joinRoom = GameRoomsParticipants::create([
        'game_room_id' => $room_id,
        'user_id' => $user_id,
      ]);

      event(new UserJoinRoom($user, $room_code));
    }else{
      return response()->json([
        'error' => "This room is full."
      ]);
    }
  }

  public function inviteFriend(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'room_code' => 'required|exists:game_rooms',
        'friend_id' => 'required|exists:users,id',
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    $user = \Auth::user();
    $friend = User::find($request->get('friend_id'));

    $friend->notify(new InviteFriendNotification($request->get('room_code'), $user));
  }

  public function denyInvite(Request $reuest)
  {
    $validator = Validator::make($request->all(), [
        'friend_id' => 'required|exists:users,id',
        'notification_id' => 'required|exists:notifications,id'
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    $user = \Auth::user();
    $friend = User::find($request->get('friend_id'));

    $friend->notify(new DenyInviteNotification($user));

    $notification = $user->notifications()->where('id', $request->get('notification_id'))->first();
    if($notification){
      $notification->delete();

      return response()->json([
        'done' => true,
      ]);
    }
  }
}
