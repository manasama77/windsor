<?php

namespace Database\Seeders;

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
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
                'subject_group_id' => 1,
                'name'             => 'Pendidikan Agama dan Budi Pekerti',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 1,
                'name'             => 'Pendidikan Pancasila dan Kewarganegaraan (PPKn)',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 1,
                'name'             => 'Bahasa Indonesia',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 1,
                'name'             => 'Matematika',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 1,
                'name'             => 'Sejarah Indonesia',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 1,
                'name'             => 'Bahasa Inggris',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 2,
                'name'             => 'Geografi',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 2,
                'name'             => 'Sejarah',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 2,
                'name'             => 'Sosiologi',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 2,
                'name'             => 'Ekonomi',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 3,
                'name'             => 'Public Speaking',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 3,
                'name'             => 'Teknologi Infromasi dan Komunikasi',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 4,
                'name'             => 'Seni dan Budaya',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 4,
                'name'             => 'Pendidikan Jasmani dan Olah Raga',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 4,
                'name'             => 'Prakarya dan Kewirausahaan',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'subject_group_id' => 5,
                'name'             => 'English For IELTS',
                'is_active'        => 1,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
        ];
        Subject::insert($data);
    }
}
