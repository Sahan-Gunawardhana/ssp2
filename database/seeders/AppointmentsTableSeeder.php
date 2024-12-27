<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->insert([
            [
                'customer_id' => 1,
                'pet_name' => 'Buddy',
                'drop_off_date' => Carbon::now()->addDays(2),
                'pick_up_date' => Carbon::now()->addDays(3),
                'description' => 'Overnight stay and grooming. Needs extra care for separation anxiety.',
                'status' => 'upcoming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'pet_name' => 'Milo',
                'drop_off_date' => Carbon::now()->subDays(5),
                'pick_up_date' => Carbon::now()->subDays(4),
                'description' => 'Full day of playtime and socialization. Friendly with other dogs.',
                'status' => 'passed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'pet_name' => 'Bella',
                'drop_off_date' => Carbon::now()->subDays(2),
                'pick_up_date' => Carbon::now()->subDay(),
                'description' => 'Morning walk and feeding. Bella has a sensitive stomach, follow specific diet instructions.',
                'status' => 'passed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
