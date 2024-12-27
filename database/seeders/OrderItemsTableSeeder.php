<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 3,
                'box_id'=> null,
                'product_id' => 1,
                'quantity' => 2,
                'total' => 1500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'box_id'=> null,
                'product_id' => 2,
                'quantity' => 1,
                'total' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'order_id' => 3,
                'box_id'=> null,
                'product_id' => 3,
                'quantity' => 3,
                'total' => 7500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => null,
                'box_id'=> 1,
                'product_id' => 1,
                'quantity' => 3,
                'total' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => null,
                'box_id'=> 1,
                'product_id' => 2,
                'quantity' => 3,
                'total' => 4000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'box_id'=> null,
                'product_id' => 3,
                'quantity' => 3,
                'total' => 7500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'box_id'=> null,
                'product_id' => 1,
                'quantity' => 3,
                'total' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'box_id'=> null,
                'product_id' => 2,
                'quantity' => 3,
                'total' => 4000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
