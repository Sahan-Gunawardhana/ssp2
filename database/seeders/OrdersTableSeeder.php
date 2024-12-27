<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'customer_id' => 1,
                'order_date' => now(),
                'total' => 3000.00,
                'zip_code' => '10100',
                'province' => 'Western',
                'city' => 'Colombo',
                'street' => '123 Main Street',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'order_date' => now(),
                'total' => 3000.00,
                'zip_code' => '10101',
                'province' => 'Western',
                'city' => 'Colombo',
                'street' => '456 Secondary Street',
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'order_date' => "2024-12-01",
                'total' => 22500.00,
                'zip_code' => '10102',
                'province' => 'Western',
                'city' => 'Colombo',
                'street' => '789 Tertiary Street',
                'status' => 'shipped',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'order_date' => now(),
                'total' => 22500.00,
                'zip_code' => '10102',
                'province' => 'Western',
                'city' => 'Colombo',
                'street' => '789 Tertiary Street',
                'status' => 'shipped',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
