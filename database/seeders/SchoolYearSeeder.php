<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolYear::create([
            'name'             => '2021-2022',
            'even_period_from' => '2021-07-01',
            'even_period_to'   => '2021-12-31',
            'odd_period_from'  => '2022-01-01',
            'odd_period_to'    => '2022-06-30',
            'is_active'        => 1,
        ]);
    }
}
