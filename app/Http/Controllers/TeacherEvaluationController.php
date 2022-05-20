<?php

namespace App\Http\Controllers;

use App\Models\StudentEvaluation;
use App\Models\Meeting;
use App\Models\Student;
use App\Models\StudentWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherEvaluationController extends Controller
{
    public function index($id)
    {
        $meetings = Meeting::select([
            'school_years.name AS school_year',
            'teachers.name as teacher_name',
            'class_rooms.name AS class_room_name',
            'subjects.name as subject_name',
            'meetings.title',
            'meetings.homeroom_teacher_id',
        ])
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'meetings.homeroom_teacher_id')
            ->leftJoin('school_years', 'school_years.id', '=', 'homeroom_teachers.school_year_id')
            ->leftJoin('class_rooms', 'class_rooms.id', '=', 'homeroom_teachers.class_room_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'meetings.teacher_id')
            ->leftJoin('subjects', 'subjects.id', '=', 'meetings.subject_id')
            ->where('meetings.id', '=', $id)
            ->first();
        if (!$meetings) return abort(404);

        $students = Meeting::select([
            'class_room_students.student_id',
            'students.name AS student_name',
            'student_works.id AS student_work_id',
            'student_works.file_name',
            'student_works.file_path',
            'student_works.mime',
            'student_evaluations.value',
        ])
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'meetings.homeroom_teacher_id')
            ->leftJoin('class_room_students', 'class_room_students.class_room_id', '=', 'homeroom_teachers.id')
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->leftJoin('student_works', function ($join) {
                $join->on('student_works.meeting_id', '=', 'meetings.id')
                    ->on('student_works.student_id', '=', 'class_room_students.student_id');
            })
            ->leftJoin('student_evaluations', function ($join) {
                $join->on('student_evaluations.meeting_id', '=', 'meetings.id')
                    ->on('student_evaluations.student_id', '=', 'class_room_students.student_id');
            })
            ->where('meetings.id', '=', $id)
            ->orderBy('students.name')
            ->get();

        $data = [
            'page_title'          => "Penilaian",
            'content_title'       => "Penilaian",
            'meeting_id'          => $id,
            'homeroom_teacher_id' => $meetings->homeroom_teacher_id,
            'meetings'            => $meetings,
            'students'            => $students,
        ];
        return view('teacher.penilaian.main', $data);
    }

    public function upsert(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $arr_value  = $request->value;

        $students = Meeting::select('class_room_students.student_id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'meetings.homeroom_teacher_id')
            ->leftJoin('class_room_students', 'class_room_students.class_room_id', '=', 'homeroom_teachers.id')
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->where('meetings.id', '=', $meeting_id)
            ->orderBy('students.name')
            ->get();

        $i = 0;
        foreach ($students as $student) {
            $student_id = $student->student_id;
            $value      = ($arr_value[$i] == null) ? 0 : $arr_value[$i];

            StudentEvaluation::updateOrCreate(
                ['meeting_id' => $meeting_id, 'student_id' => $student_id],
                ['value' => $value]
            );
            $i++;
        }
        return response()->json([
            'code' => 200
        ], 200);
    }

    public function download($student_work_id)
    {
        $file = StudentWork::find($student_work_id);
        if (!$file) return abort(401);
        return response()->download('storage/' . $file->file_path, $file->file_name, [
            'Content-Type' => $file->mime
        ]);
    }
}
