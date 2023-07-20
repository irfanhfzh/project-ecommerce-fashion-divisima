<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            'size' => 'XS',
        ]);
        DB::table('sizes')->insert([
            'size' => 'S',
        ]);
        DB::table('sizes')->insert([
            'size' => 'M',
        ]);
        DB::table('sizes')->insert([
            'size' => 'L',
        ]);
        DB::table('sizes')->insert([
            'size' => 'XL',
        ]);
        DB::table('sizes')->insert([
            'size' => 'XXL',
        ]);
    }
}
