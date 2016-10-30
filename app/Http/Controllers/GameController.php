<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Games;

class GameController extends Controller
{
    public function getGames () {
        $games = [];

        $games['xp'] = Games::where('xp_reward', '!=', 0)->where('bits_reward', 0)->get();
        $games['xpbits'] = Games::where('xp_reward', '!=', 0)->where('bits_reward', '!=', 0)->get();

        return $games;
    }

    public function getGame (Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:games',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $game = Games::find($request->get('id'));

        return $game;
    }
}
