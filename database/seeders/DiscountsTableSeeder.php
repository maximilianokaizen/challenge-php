<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DiscountsTableSeeder extends Seeder
{
    public function run()
    {
        $brands = DB::table('brands')->pluck('id');
        $regions = DB::table('regions')->pluck('id');
        $accessTypes = DB::table('access_types')->pluck('code');

        for ($i = 0; $i < rand(30, 50); $i++) {
            $startDate = Carbon::today()->subDays(rand(0, 365));
            $endDate = (clone $startDate)->addDays(rand(1, 365));

            DB::table('discounts')->insert([
                'name' => Str::random(10),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'priority' => rand(1, 1000),
                'active' => rand(0, 1),
                'region_id' => $regions->random(),
                'brand_id' => $brands->random(),
                'access_type_code' => $accessTypes->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
