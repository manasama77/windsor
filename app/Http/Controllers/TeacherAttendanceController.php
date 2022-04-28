<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherAttendanceController extends Controller
{
    public function index($id)
    {
        $meetings = Meeting::find($id)->first();
        // $students = Student::orderBy('name')->classroomStudent()->where('homeroom_teacher_id', '=', $meetings->homeroom_teacher_id)->first();
        $students = DB::table('class_room_students')
            ->select('class_room_students.student_id', 'students.name')
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->where('class_room_students.homeroom_teacher_id', '=', $meetings->homeroom_teacher_id)
            ->orderBy('students.name')
            ->get();
        $data = [
            'page_title'    => "Presensi",
            'content_title' => "Presensi",
            'meetings'      => $meetings,
            'students'      => $students,
        ];
        return view('teacher.presensi.main', $data);
    }
}
