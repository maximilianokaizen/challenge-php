<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AccessTypesTableSeeder::class);
        $this->call(DiscountsTableSeeder::class);
    }
}
