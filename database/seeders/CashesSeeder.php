<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CashesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cashes')->insert([
            'cash' => 'Available',
        ]);
        DB::table('cashes')->insert([
            'cash' => 'Not Available',
        ]);
    }
}
