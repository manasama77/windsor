<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;

class AdminSetupSubjectController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Setup - Mata Pelajaran",
            'content_title' => "Setup - Mata Pelajaran",
        ];
        return view('admin.setup.mapel.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Subject::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.setup.mapel.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = Subject::find($id);
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|min:4',
            'is_active'        => 'required|boolean',
        ]);

        $data            = new Subject;
        $data->name      = $request->name;
        $data->is_active = $request->is_active;
        $data->save();
        return redirect()->route('admin.setup.mapel')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required|min:4',
            'is_active'        => 'required|boolean',
        ]);

        $data                   = Subject::find($id);
        $data->name             = $request->name;
        $data->is_active        = $request->is_active;
        $data->save();

        if ($data) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = Subject::find($request->id);
        $exec->setup_teacher()->detach();
        $exec->parents()->detach();
        $exec->delete();
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
