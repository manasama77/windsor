<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HomeroomTeacher;

class AdminTeacherHomeroomTeacherController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::all();
        $teachers    = Teacher::all();
        $data = [
            'page_title'    => "Management Guru - Daftar Wali Kelas",
            'content_title' => "Management Guru - Daftar Wali Kelas",
            'schoolYears'   => $schoolYears,
            'teachers'      => $teachers,
        ];
        return view('admin.guru.wali_kelas.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = HomeroomTeacher::with(['schoolYear', 'teacher', 'classRoom'])->orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.guru.wali_kelas.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = HomeroomTeacher::find($id);
        return response()->json($admin);
    }

    public function show_available_kelas($school_year_id)
    {
        $classrooms = ClassRoom::whereNotIn('id', function ($query) use ($school_year_id) {
            $query
                ->select('class_room_id')
                ->from('homeroom_teachers')
                ->where('homeroom_teachers.school_year_id', '=', $school_year_id);
        })->where('is_active', '=', 1)->get();
        return response()->json($classrooms);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year_id' => 'required',
            'teacher_id'     => 'required',
            'class_room_id'  => 'required',
        ]);
        HomeroomTeacher::create($request->all());
        return redirect()->route('admin.guru.wali_kelas')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'school_year_id' => 'required',
            'teacher_id'     => 'required',
            'class_room_id'  => 'required',
        ]);
        $exec = HomeroomTeacher::find($id)->update($request->all());

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = HomeroomTeacher::find($request->id)->delete($request->id);
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
