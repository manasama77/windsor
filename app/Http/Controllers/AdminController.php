<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login.main');
    }

    public function auth(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $this->init_session();
            return redirect()->route('admin.dashboard')->with('success', 'Login Success');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    public function init_session()
    {
        $arr_school_year = SchoolYear::where('is_active', 1)->first();
        Session::put('active_year', ($arr_school_year->name) ?? null);
    }

    public function register()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        Admin::insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.register')->with('success', 'Create Success');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout success');
    }
}
