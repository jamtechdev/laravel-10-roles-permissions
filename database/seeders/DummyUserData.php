<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;


class DummyUserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1,1000) as $index) 
        {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $username = explode("@", $user->email);
            $getusername = $username[0];
            $user->username = $getusername;            
            $user->password = Hash::make('12345678');
            $user->save();
      
        }
     
    }
}
