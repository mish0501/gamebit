<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\GameRooms;
use App\GameRoomsParticipants;
use App\NextWordGame;

class NextWordGameController extends Controller
{
  public function startGame(Request $request){
    $validator = Validator::make($request->all(), [
        'room_code' => 'required|exists:game_rooms',
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    $room_code = $request->get('room_code')

    $room = GameRooms::where('room_code', $room_code)->first();
    $room->update(['status' => 1]);

    $players = GameRoomsParticipants::where('room_id', $room->id)->with('users')->orderByRaw("RAND()")->get();

    event(new GameStarted($room_code, $players));
  }

  public function newWord(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'room_code' => 'required|exists:game_rooms',
      'user_id' => 'required|exists:game_rooms_participants,user_id'
    ]);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $room_code = $request->get('room_code');

    $word = $request->has('word');

    $room = GameRooms::where('room_code', $room_code)->first();

    if($word !== ""){
      $newWord = NextWordGame::create([
        'room_id' => $room->id,
        'user_id' => $request->get('user_id'),
        'word' => $word
      ]);

      event(new NewWord($word, $room_code));
    }

    return response()->json([
      'done' => true
    ]);
  }
}
