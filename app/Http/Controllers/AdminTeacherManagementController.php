<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AdminTeacherManagementController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Management Guru - Daftar Guru",
            'content_title' => "Management Guru - Daftar Guru",
        ];
        return view('admin.guru.daftar.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Teacher::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.guru.daftar.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = Teacher::find($id);
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:4',
            'email'    => 'required|unique:teachers,email|:rfc,dns',
            'password' => 'required|min:4|confirmed',
            'phone'    => 'required|min:5',
        ]);
        $admin           = new Teacher;
        $admin->name     = $request->name;
        $admin->phone    = $request->phone;
        $admin->address  = trim($request->address);
        $admin->email    = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.guru.daftar')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|min:4',
            'phone' => 'required|min:5',
        ]);
        $exec = Teacher::where('id', '=', $id)->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = Teacher::find($request->id)->delete($request->id);
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }

    public function reset_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:4',
        ]);
        $exec = Teacher::where('id', '=', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }
}
