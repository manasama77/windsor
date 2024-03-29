<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HomeroomTeacher;
use App\Models\ClassRoomStudent;
use App\Http\Controllers\Controller;

class AdminClassController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Management Kelas",
            'content_title' => "Management Kelas",
        ];
        return view('admin.kelas.main', $data);
    }

    public function test()
    {
        $x = ClassRoomStudent::where('homeroom_teacher_id', '=', 1)->get();
        $students = Student::all();

        $diff = $students->diff($x);
        dd($diff);

        $filter = [];
        foreach ($students as $student) {
            //
        }
        dd($filter);
        // $e = HomeroomTeacher::with(['schoolYear', 'classRoom', 'teacher'])->withCount('classRoomStudent')->get();
        // foreach ($e as $key) {
        //     echo $key->schoolYear->name . " " . $key->classRoom->name . " " . $key->teacher->name . " " . $key->class_room_student_count . "<br/>";
        // }
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = HomeroomTeacher::with(['schoolYear', 'classRoom', 'teacher'])->withCount('classRoomStudent')->get()->sortByDesc('schoolYear.name')->sortBy('teacher.name');
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.kelas.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = ClassRoomStudent::find($id);
        return response()->json($admin);
    }

    public function show_wali_kelas(Request $request)
    {
        $data = HomeroomTeacher::with(['teacher'])->where('school_year_id', $request->school_year_id)->where('class_room_id', $request->class_room_id)->get();
        return response()->json($data);
    }

    public function edit($homeroom_teacher_id)
    {
        $arr                   = HomeroomTeacher::with(['schoolYear', 'classRoom', 'teacher'])->where('id', $homeroom_teacher_id)->get();
        $school_year_id        = "";
        $school_year_name      = "";
        $classroom_name        = "";
        $homeroom_teacher_name = "";

        foreach ($arr as $key) {
            $school_year_id        = $key->schoolYear->id;
            $school_year_name      = $key->schoolYear->name;
            $class_room_id         = $key->classRoom->id;
            $classroom_name        = $key->classRoom->name;
            $homeroom_teacher_name = $key->teacher->name;
        }

        $rulesStudent1 = ClassRoomStudent::select('class_room_students.student_id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'class_room_students.homeroom_teacher_id')
            ->where('homeroom_teachers.school_year_id', '=', $school_year_id)
            ->where('homeroom_teachers.class_room_id', '!=', $class_room_id)
            ->get();

        $availStudent = Student::whereNotIn('id', $rulesStudent1->toArray())
            ->orderBy('name')
            ->get();

        $usedStudent = ClassRoomStudent::select('class_room_students.student_id')
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'class_room_students.homeroom_teacher_id')
            ->where('homeroom_teachers.school_year_id', '=', $school_year_id)
            ->where('homeroom_teachers.class_room_id', '=', $class_room_id)
            ->get();

        $arrUsedStudent = [];
        foreach ($usedStudent as $a) {
            array_push($arrUsedStudent, $a->student_id);
        }

        $data = [
            'page_title'            => "Management Kelas - Edit Data Siswa Kelas",
            'content_title'         => "Management Kelas - Edit Data Siswa Kelas",
            'homeroom_teacher_id'   => $homeroom_teacher_id,
            'school_year_name'      => $school_year_name,
            'class_room_id'         => $class_room_id,
            'classroom_name'        => $classroom_name,
            'homeroom_teacher_name' => $homeroom_teacher_name,
            'availStudent'          => $availStudent,
            'usedStudent'           => $arrUsedStudent,
        ];
        return view('admin.kelas.form', $data);
    }

    public function update(Request $request, $homeroom_teacher_id, $class_room_id)
    {
        $arr_siswa = $request->arr_siswa;

        ClassRoomStudent::where('homeroom_teacher_id', $homeroom_teacher_id)->delete();

        if ($arr_siswa) {
            foreach ($arr_siswa as $key => $val) {
                $exec                      = new ClassRoomStudent;
                $exec->id                  = Str::uuid();
                $exec->homeroom_teacher_id = $homeroom_teacher_id;
                $exec->class_room_id       = $class_room_id;
                $exec->student_id          = $val;
                $exec->save();
            }
        }
        return response()->json(['code' => 200]);
    }
}
