<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Management Siswa - Daftar Siswa",
            'content_title' => "Management Siswa - Daftar Siswa",
        ];
        return view('admin.siswa.daftar.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.siswa.daftar.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = Student::find($id);
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
        $admin           = new Student;
        $admin->name     = $request->name;
        $admin->phone    = $request->phone;
        $admin->address  = trim($request->address);
        $admin->email    = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.siswa.daftar')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|min:4',
            'phone' => 'required|min:5',
        ]);
        $exec = Student::where('id', '=', $id)->update([
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
        $exec = Student::find($request->id)->delete($request->id);
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
        $exec = Student::where('id', '=', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }
}
