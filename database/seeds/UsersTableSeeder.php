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
        //
       $user = App\User::create([
        	'name' => 'Ifte Kharul Islam',
        	'email' => 'freaktanjim@gmail.com',
        	'password'=>bcrypt('password'),
            'admin' => 1
        ]);


        App\Profile::create([

            'user_id' => $user->id,
            'avatar'  => 'uploads/avatars/avatar.png',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam',
            'github' => 'github.com@tanj1m',
            'stackoverflow' => 'https://stackoverflow.com/users/12040805/ifte-kharul-islam'



        ]);
    }
}
