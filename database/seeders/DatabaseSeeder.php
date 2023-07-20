<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SizeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LevelSeeder;
use Database\Seeders\CashesSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\VariantSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SizeSeeder::class,
            CashesSeeder::class,
            StatusSeeder::class,
            ProductSeeder::class,
            VariantSeeder::class,
        ]);
    }
}
