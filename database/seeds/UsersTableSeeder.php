<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
          'name' => 'Mertin Dervish',
          'username' => 'mertindervish',
          'email' => 'mertindervish@gmail.com',
          'password' => bcrypt('123456789')
        ]);

        App\User::create([
          'name' => 'Mihail Georgiev',
          'username' => 'misho_0501',
          'email' => 'mmisho0501@gmail.com',
          'password' => bcrypt('123456789')
        ]);
    }
}
