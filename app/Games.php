<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'description', 'bits_reward', 'xp_reward'
  ];

  public function game_rooms()
  {
      return $this->hasMany('App\GameRooms');
  }
}
