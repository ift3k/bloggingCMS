<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeding users
        \App\Setting::create([

        	'site_name' => "Tanjim's Blog",
        	'contact_number' => '+880 1775-982499',
        	'contact_email' => 'tanjim1337@gmail.com',
        	'address' => 'Dhaka,Bangladesh'
        ]);
    }
}
