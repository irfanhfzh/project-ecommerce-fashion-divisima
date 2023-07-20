<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // foreach( range(1,8) as $index ){
        //     DB::table('products')->insert([
        //         'category_id' => rand(1,5),
        //         'code' => $faker->unique()->randomNumber,
        //         'slug' => $faker->name,
        //         'name' => $faker->name,
        //         'price' => $faker->randomDigit,
        //         'size_id' => rand(1,6),
        //         'qty' => $faker->randomDigit,
        //         'returns' => $faker->randomDigit,
        //         'delivery' => $faker->randomDigit,
        //         'stock_id' => rand(1,2),
        //         'cash_id' => rand(1,2),
        //         'variant_id' => rand(1,3),
        //         'description' => $faker->paragraph,
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         'image' => $faker->imageUrl($width = 640, $height = 480)
        //     ]);
        // }

        for ($i = 1; $i < 30; $i++) {
            Product::create([
                'code' => $faker->unique()->randomNumber,
                'name' => 'Test Product' . $i,
                'slug' => 'test-product-' . $i,
                'image1' => '1_1618662691.jpg',
                'image2' => '1_1618662691.jpg',
                'image3' => '1_1618662691.jpg',
                'image4' => '1_1618662691.jpg',
                'category_id' => rand(1,6),
                'price' => $faker->randomNumber,
                'variant' => 'Merah, Putih, Kuning, Hitam',
                'qty' => '15',
                'size' => 'S, M, L, XL, XXL',
                'cash_id' => '1',
                'returns' => '7',
                'delivery' => '4',
                'featured' => '1',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem.',
            ]);
        }
    }
}
