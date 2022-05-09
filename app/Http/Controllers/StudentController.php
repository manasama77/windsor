<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\ClassRoomStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.login.main');
    }

    public function auth(Request $request)
    {
        if (Auth::guard('student')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $init = $this->init_session();
            if ($init === false) {
                Auth::guard('student')->logout();
                return redirect('/student/login')->with('error', 'Kamu Belum Memiliki Kelas');
            }
            return redirect()->route('student.pertemuan')->with('success', 'Login Success');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    public function init_session()
    {
        $student_id = Auth::guard('student')->user()->id;
        $class = ClassRoomStudent::select('homeroom_teachers.id as homeroom_teacher_id', 'class_rooms.id as class_id', 'class_rooms.name as class_name')
            ->where('student_id', '=', $student_id)
            ->leftJoin('homeroom_teachers', 'homeroom_teachers.id', '=', 'class_room_students.homeroom_teacher_id')
            ->leftJoin('class_rooms', 'class_rooms.id', '=', 'homeroom_teachers.class_room_id')
            ->first();

        if ($class == null) {
            return false;
        }

        Session::put('student_id', Auth::guard('student')->user()->id);
        Session::put('student_name', Auth::guard('student')->user()->name);
        Session::put('class_id', $class->class_id);
        Session::put('class_name', $class->class_name);
        Session::put('homeroom_teacher_id', $class->homeroom_teacher_id);

        $arr_school_year = SchoolYear::where('is_active', 1)->first();
        Session::put('active_year', ($arr_school_year->name) ?? null);

        return true;
    }

    public function register()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        Student::insert([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('student.register')->with('success', 'Create Success');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with('success', 'Logout success');
    }
}
