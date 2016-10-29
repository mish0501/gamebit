<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameRoomsParticipants extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'game_room_id', 'user_id'
  ];

  public function game_room()
  {
    return $this->hasOne('App\GameRooms', 'game_room_id');
  }

  public function users()
  {
    return $this->hasMany('App\Users');
  }
}
