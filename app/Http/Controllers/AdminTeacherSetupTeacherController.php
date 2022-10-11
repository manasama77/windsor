<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SetupTeacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use App\Models\Subject;

class AdminTeacherSetupTeacherController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::all();
        $classRooms  = ClassRoom::all();
        $teachers    = Teacher::all();
        $subjects    = Subject::all();
        $data = [
            'page_title'    => "Management Guru - Daftar Pengajar",
            'content_title' => "Management Guru - Daftar Pengajar",
            'schoolYears'   => $schoolYears,
            'classRooms'    => $classRooms,
            'teachers'      => $teachers,
            'subjects'      => $subjects,
        ];
        return view('admin.guru.pengajar.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = SetupTeacher::with(['schoolYear', 'classRoom', 'teacher', 'subject'])->orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.guru.pengajar.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = SetupTeacher::find($id);
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year_id' => 'required',
            'class_room_id'  => 'required',
            'teacher_id'     => 'required',
            'subject_id'     => 'required',
        ]);
        SetupTeacher::create($request->all());
        return redirect()->route('admin.guru.pengajar')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'school_year_id' => 'required',
            'class_room_id'  => 'required',
            'teacher_id'     => 'required',
            'subject_id'     => 'required',
        ]);
        $exec = SetupTeacher::find($id)->update($request->all());

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = SetupTeacher::find($request->id)->delete($request->id);
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
