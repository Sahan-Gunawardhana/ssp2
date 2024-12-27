<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boxes')->insert([
            [
                'customer_id' => 2, 
                'subscription_type' => 'monthly',
                'status' => true,
                'price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
