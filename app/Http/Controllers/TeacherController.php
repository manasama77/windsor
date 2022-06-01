<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Teacher;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function index()
    {
        return view('teacher.login.main');
    }

    public function auth(Request $request)
    {
        if (Auth::guard('teacher')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $this->init_session();
            return redirect()->route('teacher.dashboard')->with('success', 'Login Success');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    public function init_session()
    {
        $arr_school_year = SchoolYear::where('is_active', 1)->first();

        // REMOVE PRSET SESSION
        Session::remove('active_year');
        Session::remove('teacher_name');
        Session::remove('homeroom_name');
        Session::remove('subjects');

        Session::put('active_year', ($arr_school_year->name) ?? null);
        Session::put('teacher_id', Auth::guard('teacher')->user()->id);
        Session::put('teacher_name', Auth::guard('teacher')->user()->name);

        $arr_teacher = Teacher::with(['setup_teacher', 'class_room'])->withCount('homeroom_teacher')->find(Auth::guard('teacher')->user()->id);
        // dd($arr_teacher);
        if ($arr_teacher->homeroom_teacher_count > 0) {
            $homeroom_name = "";
            foreach ($arr_teacher->class_room as $key) {
                $homeroom_name = $key->name;
            }
            Session::put('homeroom_name', $homeroom_name);
        }

        $arr_subject = [];
        foreach ($arr_teacher->setup_teacher as $key) {
            $subject_name = $key->subject->name;
            array_push($arr_subject, $subject_name);
        }
        Session::put('subjects', $arr_subject);
    }

    public function register()
    {
        return view('admin.teacher.create');
    }

    public function store(Request $request)
    {
        Teacher::insert([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'address'    => $request->address,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('teacher.register')->with('success', 'Create Success');
    }

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success', 'Logout success');
    }
}
