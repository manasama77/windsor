<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\HomeroomTeacher;
use App\Models\Meeting;
use App\Models\SetupTeacher;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherMeetingController extends Controller
{
    public function index(Request $request)
    {
        $setupTeachers = SetupTeacher::with(['teacher' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->get();

        $classRooms = ClassRoom::has('homeroom_teacher.classRoom')->get();

        $data = [
            'page_title'    => "Management Pertemuan",
            'content_title' => "Management Pertemuan",
            'setupTeachers' => $setupTeachers,
            'classRooms'    => $classRooms,
        ];
        return view('teacher.pertemuan.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'teacher.pertemuan.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show_subject($teacher_id)
    {
        $subjects = SetupTeacher::with(['subject' => function ($query) {
            $query->where('is_active', '=', 1);
        }])->where('teacher_id', '=', $teacher_id)->get();
        return response()->json($subjects);
    }

    public function add()
    {
        //
    }
}
