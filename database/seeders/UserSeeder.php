<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        User::create([
            'level_id' => '2',
            'username' => 'user',
            'full_name' => 'nama user',
            'no_hp' => '089629933096',
            'address' => 'Jl. Kenangan aku dan Dia ahhhhhh co cwit',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);
        User::create([
            'level_id' => '1',
            'username' => 'admin',
            'full_name' => 'nama admin',
            'no_hp' => '089629933096',
            'address' => 'Jl. Kenangan aku dan Dia ahhhhhh co cwit banget admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
