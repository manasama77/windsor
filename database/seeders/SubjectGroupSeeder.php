<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\SubjectGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectGroupSeeder extends Seeder
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
                'name'       => 'Kelompok A (Umum)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Kelompok B (Peminatan IPS)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Kelompok B (Peminatan IPA)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Kelompok C (Pemberdayaan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Kelompok D (Keterampilan Wajib)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'      => 'Kelompok E (Keterampilan Pilihan)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        SubjectGroup::insert($data);
    }
}
