<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'            => '1A - IPA - Mandiri',
                'is_active'       => 1,
                'classroom_type'  => 'mandiri',
                'vocational_type' => 'ipa',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'name'            => '1A - IPS - Mandiri',
                'is_active'       => 1,
                'classroom_type'  => 'mandiri',
                'vocational_type' => 'ips',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
        ];
        ClassRoom::insert($data);
    }
}
