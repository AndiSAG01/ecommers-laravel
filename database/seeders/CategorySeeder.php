<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Liquid',
            'slug' => 'liquid',
            'parent_id' => NULL,
            'status' => 1,
        ]);

        Category::create([
            'name' => 'Saltnic',
            'slug' => 'saltnic',
            'parent_id' => 1,
            'status' => 1,
        ]);

        Category::create([
            'name' => 'Freebase',
            'slug' => 'freebase',
            'parent_id' => 1,
            'status' => 1,
        ]);

        Category::create([
            'name' => 'Pod Mod',
            'slug' => 'pod-mod',
            'parent_id' => NULL,
            'status' => 1,
        ]);

        Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'parent_id' => NULL,
            'status' => 1,
        ]);

        Category::create([
            'name' => 'Atomizer',
            'slug' => 'atomizer',
            'parent_id' => NULL,
            'status' => 1,
        ]);
    }
}
