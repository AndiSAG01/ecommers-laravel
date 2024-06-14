<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);
        $this->call([CustomerSeeder::class]);
        $this->call([CategorySeeder::class]);
        $this->call([ProductSeeder::class]);

        $this->call([ProvinceSeeder::class]);
        $this->call([CitySeeder::class]);
        $this->call([DistrictSeeder::class]);
    }
}