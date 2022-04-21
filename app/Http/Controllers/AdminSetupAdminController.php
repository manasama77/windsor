<?php

namespace App\Http\Controllers;

// use Datatables;
use datatables;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AdminSetupAdminController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Setup - Admin",
            'content_title' => "Setup - Admin",
        ];
        return view('admin.setup.admin.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.setup.admin.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|min:4',
            'email'            => 'required|unique:admins,email|:rfc,dns',
            'password'         => 'required|min:4|confirmed',
        ]);
        // Admin::create($request->all());
        $admin           = new Admin;
        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.setup.admin')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required|min:4',
        ]);
        $exec = Admin::where('id', '=', $id)->update([
            'name' => $request->name
        ]);

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = Admin::find($request->id)->delete($request->id);
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
        $exec = Admin::where('id', '=', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        if ($exec) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }
}
