<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('1'),
            'phone' => '081234567890',
            'address' => 'Jakarta',
            'postal_code' => 36121,
            'district_id' => 2130,
            'status' => 1
        ]);
    }
}
