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
        Session::put('active_year', ($arr_school_year->name) ?? null);

        $arr_teacher = Teacher::with(['class_room'])->withCount('homeroom_teacher')->find(Auth::guard('teacher')->user()->id);
        if ($arr_teacher->homeroom_teacher_count > 0) {
            $homeroom_name = "";
            foreach ($arr_teacher->class_room as $key) {
                $homeroom_name = $key->name;
            }
            Session::put('homeroom_name', $homeroom_name);
        }
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
