<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        // $arr_teacher = Teacher::with(['class_room'])->withCount('homeroom_teacher')->where('id', 1)->get();
        // foreach ($arr_teacher->flatMap->class_room as $key) {
        //     echo $key->name;
        // }
        // dd($arr_teacher);

        $arr_admin = Admin::all();
        $arr_teacher = Teacher::all();
        $arr_student = Student::all();
        $arr_subject = Subject::all();
        $data = [
            'page_title'    => "Dashboard",
            'content_title' => "Dashboard",
            'total_admin'   => $arr_admin->count(),
            'total_teacher' => $arr_teacher->count(),
            'total_student' => $arr_student->count(),
            'total_subject' => $arr_subject->count(),
        ];
        return view('teacher.dashboard.main', $data);
    }
}
