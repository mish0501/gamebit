<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Games::create([
          'name' => 'Next Word',
          'description' => "A group of players, each one is typing a word which is within the meaning of the previous player's word.",
        ]);
    }
}
