<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherAttendanceController extends Controller
{
    public function index($id)
    {
        $meetings = Meeting::with('attendance')->find($id)->first();
        $students = DB::table('class_room_students')
            ->select('class_room_students.student_id', 'students.name')
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->where('class_room_students.homeroom_teacher_id', '=', $meetings->homeroom_teacher_id)
            ->orderBy('students.name')
            ->get();
        $data = [
            'page_title'          => "Presensi",
            'content_title'       => "Presensi",
            'meeting_id'          => $id,
            'homeroom_teacher_id' => $meetings->homeroom_teacher_id,
            'meetings'            => $meetings,
            'students'            => $students,
        ];
        return view('teacher.presensi.main', $data);
    }

    public function upsert(Request $request)
    {
        $meeting_id          = $request->meeting_id;
        $homeroom_teacher_id = $request->homeroom_teacher_id;
        $arr_status_presence = $request->status_presence;
        $arr_description     = $request->description;

        $students = DB::table('class_room_students')
            ->select('class_room_students.student_id')
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->where('class_room_students.homeroom_teacher_id', '=', $homeroom_teacher_id)
            ->orderBy('students.name')
            ->get();

        $i = 0;
        foreach ($students as $student) {
            $student_id = $student->student_id;
            // dd(($arr_status_presence[$i] == null) ? '' : $arr_status_presence[$i]);
            $status_presence = ($arr_status_presence[$i] == null) ? ' ' : $arr_status_presence[$i];
            $description     = ($arr_description[$i] == null) ? ' ' : $arr_description[$i];

            Attendance::updateOrCreate(
                ['meeting_id' => $meeting_id, 'student_id' => $student_id],
                ['status_presence' => $status_presence, 'description' => $description]
            );
            $i++;
        }
        return response()->json([
            'code' => 200
        ], 200);
    }

    public function cek_presensi($meeting_id)
    {
        $data = Attendance::where('meeting_id', '=', $meeting_id)->get();

        return response()->json([
            'code' => 200,
            'data' => $data
        ], 200);
    }
}
