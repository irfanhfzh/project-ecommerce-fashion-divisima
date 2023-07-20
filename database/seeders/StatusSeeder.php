<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'status' => 'Unconfirmed',
        ]);
        DB::table('statuses')->insert([
            'status' => 'On Process',
        ]);
        DB::table('statuses')->insert([
            'status' => 'On Delivery',
        ]);
        DB::table('statuses')->insert([
            'status' => 'Product Arrived',
        ]);
    }
}
