<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameRooms extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'game_id', 'room_code'
  ];

  public function game()
  {
    return $this->hasOne('App\Games');
  }
}
