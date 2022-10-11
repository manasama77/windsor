<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\ClassRoomStudent;
use App\Models\ReportCard;
use App\Models\SchoolYear;
use App\Models\SetupTeacher;
use Illuminate\Http\Request;

class TeacherReportCard extends Controller
{
    public function index()
    {
        $data = [
            'page_title'    => "Data Rapot",
            'content_title' => "Data Rapot",
        ];
        return view('teacher.rapot.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = ReportCard::with(['school_year', 'class_room_student'])->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'teacher.rapot.action')
                ->make(true);
        }
    }

    public function add()
    {
        $school_years = SchoolYear::all();
        $class_rooms  = ClassRoom::all();
        $data = [
            'page_title'    => "Tambah Data Rapot",
            'content_title' => "Tambah Data Rapot",
            'school_years'  => $school_years,
            'class_rooms'   => $class_rooms,
        ];
        return view('teacher.rapot.form', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function update($id, Request $request)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function export_excel($id)
    {
        //
    }

    public function render_nilai($school_year_id, $class_room_id)
    {
        $subjects = SetupTeacher::select([
            'subjects.id',
            'subjects.name',
        ])
            ->leftJoin('subjects', 'subjects.id', '=', 'setup_teachers.subject_id')
            ->where('school_year_id', $school_year_id)
            ->where('class_room_id', $class_room_id)
            ->orderBy('subjects.name', 'asc')
            ->get();

        $students = ClassRoomStudent::select([
            'students.id',
            'students.name',
        ])
            ->leftJoin('students', 'students.id', '=', 'class_room_students.student_id')
            ->where('class_room_id', $class_room_id)
            ->orderBy('students.name', 'asc')
            ->get();

        $data = [
            'subjects' => [],
            'students' => [],
        ];

        if ($subjects->count() > 0) {
            foreach ($subjects as $key) {
                $nested['id']   = $key->id;
                $nested['name'] = $key->name;
                array_push($data['subjects'], $nested);
            }
        }

        if ($students->count() > 0) {
            foreach ($students as $key) {
                $nested['id']   = $key->id;
                $nested['name'] = $key->name;
                array_push($data['students'], $nested);
            }
        }

        return response([
            'code' => 200,
            'data' => $data,
        ]);
    }

    public function upsert($school_year_id, $period, $class_room_id, Request $request)
    {
        $arr_class_room_id         = $request->class_room_id;
        $arr_kkm                   = $request->kkm;
        $arr_pengetahuan_nilai     = $request->pengetahuan_nilai;
        $arr_pengetahuan_predikat  = $request->pengetahuan_predikat;
        $arr_keterampilan_nilai    = $request->keterampilan_nilai;
        $arr_keterampilan_predikat = $request->keterampilan_predikat;
    }
}
