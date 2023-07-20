<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 30; $i++) {
            DB::table('variants')->insert([
                'variant' => 'Merah, Putih, Kuning, Hitam',
                'product_id' => $i,
            ]);
        }
    }
}
