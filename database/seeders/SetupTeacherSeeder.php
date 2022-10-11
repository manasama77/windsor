<?php

namespace Database\Seeders;

use App\Models\SetupTeacher;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SetupTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $data =  [
                'school_year_id' => 1,
                'class_room_id'  => 1,
                'teacher_id'     => $i,
                'subject_id'     => $i,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ];
            SetupTeacher::insert($data);
        }

        for ($i = 1; $i <= 10; $i++) {
            $data =  [
                'school_year_id' => 1,
                'class_room_id'  => 2,
                'teacher_id'     => $i,
                'subject_id'     => $i,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ];
            SetupTeacher::insert($data);
        }
    }
}
