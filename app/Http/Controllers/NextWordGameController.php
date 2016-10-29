<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class NextWordGameController extends Controller
{
  public function startGame(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'room_code' => 'required|exists:game_rooms',
    ]);

    if ($validator->fails()) {
        return $validator->errors();
    }

    
  }
}
