<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'nama' => 'Woman Wear',
            'slug' => 'woman-wear',
        ]);
        DB::table('categories')->insert([
            'nama' => 'Man Wear',
            'slug' => 'man-wear',
        ]);
        DB::table('categories')->insert([
            'nama' => 'Children',
            'slug' => 'children',
        ]);
        DB::table('categories')->insert([
            'nama' => 'Bags & Purses',
            'slug' => 'bags-purses',
        ]);
        DB::table('categories')->insert([
            'nama' => 'Footwear',
            'slug' => 'footwear',
        ]);
        DB::table('categories')->insert([
            'nama' => 'Jeans',
            'slug' => 'jeans',
        ]);
    }
}
