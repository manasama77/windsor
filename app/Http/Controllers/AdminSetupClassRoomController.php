<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\HomeroomTeacher;
use App\Http\Controllers\Controller;

class AdminSetupClassRoomController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Setup - Kelas",
            'content_title' => "Setup - Kelas",
        ];
        return view('admin.setup.kelas.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = ClassRoom::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.setup.kelas.action')
                ->make(true);
        }
    }

    public function show($id)
    {
        $data = ClassRoom::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|min:2',
            'classroom_type'  => 'required',
            'vocational_type' => 'required',
            'is_active'       => 'required|boolean',
        ]);

        $data                  = new ClassRoom;
        $data->name            = $request->name;
        $data->classroom_type  = $request->classroom_type;
        $data->vocational_type = $request->vocational_type;
        $data->is_active       = 1;
        $data->save();
        return redirect()->route('admin.setup.kelas')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'            => 'required|min:4',
            'classroom_type'  => 'required',
            'vocational_type' => 'required',
            'is_active'       => 'required|boolean',
        ]);

        $data                  = ClassRoom::find($id);
        $data->name            = $request->name;
        $data->classroom_type  = $request->classroom_type;
        $data->vocational_type = $request->vocational_type;
        $data->is_active       = $request->is_active;
        $data->save();

        if ($data) {
            return response()->json(['code' => 200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function destroy(Request $request)
    {
        $exec = ClassRoom::find($request->id);
        foreach ($exec->homeroom_teacher as $homeroom_teacher) {
            $homeroom_teacher->classRoomStudent()->delete();
        }

        $exec->homeroom_teacher()->delete();
        $exec->delete();

        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
