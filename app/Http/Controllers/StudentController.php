<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.login.main');
    }

    public function auth(Request $request)
    {
        if (Auth::guard('student')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('student.dashboard')->with('success', 'Login Success');
        }

        return back()->with('error', 'Invalid Email or Password');
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

    public function dashboard()
    {
        return view('student.dashboard.main');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with('success', 'Logout success');
    }
}
