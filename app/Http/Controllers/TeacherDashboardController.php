<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TeacherDashboardController extends Controller
{

    protected $teacher_id;

    public function __construct()
    {
        $this->teacher_id = Auth::guard('teacher')->user()->id;
    }

    public function index()
    {
        $total_tugas = Meeting::where('teacher_id', '=', $this->teacher_id)->count();

        $data = [
            'page_title'    => "Dashboard",
            'content_title' => "Dashboard",
            'total_tugas'   => $total_tugas,
        ];
        return view('teacher.dashboard.main', $data);
    }
}
