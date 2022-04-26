<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use App\Models\HomeroomTeacher;
use Illuminate\Database\Seeder;

class HomeroomTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 2; $i++) {
            $data =  [
                'school_year_id' => 1,
                'class_room_id'  => $i,
                'teacher_id'     => $i,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ];
            HomeroomTeacher::insert($data);
        }
    }
}
