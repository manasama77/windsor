<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SchoolYear;
use Illuminate\Database\Seeder;
use Database\Factories\StudentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            SubjectGroupSeeder::class,
            MapelSeeder::class,
            SchoolYearSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
            ClassRoomSeeder::class,
            SetupTeacherSeeder::class,
            HomeroomTeacherSeeder::class,
        ]);
    }
}
