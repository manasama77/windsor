<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{

    public function __construct()
    {
        // dd(Auth::guard('admin')->user()->name);
        // if (!Auth::guard('admin')->check()) {
        //     echo "NO";
        //     exit;
        //     redirect()->route('admin.logout');
        // } else {
        //     echo "YES";
        //     exit;
        // }
    }
    public function index()
    {
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
        return view('admin.dashboard.main', $data);
    }
}
