<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSetupSchoolYearController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Setup - Tahun Ajar",
            'content_title' => "Setup - Tahun Ajar",
        ];
        return view('admin.setup.tahun_ajar.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = SchoolYear::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.setup.tahun_ajar.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $admin = SchoolYear::find($id);
        return response()->json($admin);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|min:4',
            'even_period_from' => 'required|date',
            'even_period_to'   => 'required|date',
            'odd_period_from'  => 'required|date',
            'odd_period_to'    => 'required|date',
            'is_active'        => 'required|boolean',
        ]);

        if ($request->is_active == 1) {
            SchoolYear::where('is_active', 1)->update(['is_active' => 0]);
            Session::put("active_year", $request->name);
        }

        $data                   = new SchoolYear;
        $data->name             = $request->name;
        $data->even_period_from = $request->even_period_from;
        $data->even_period_to   = $request->even_period_to;
        $data->odd_period_from  = $request->odd_period_from;
        $data->odd_period_to    = $request->odd_period_to;
        $data->is_active        = $request->is_active;
        $data->save();
        return redirect()->route('admin.setup.tahun_ajar')->with('success', 'Create Success');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required|min:4',
            'even_period_from' => 'required|date',
            'even_period_to'   => 'required|date',
            'odd_period_from'  => 'required|date',
            'odd_period_to'    => 'required|date',
            'is_active'        => 'required|boolean',
        ]);

        if ($request->is_active == 1) {
            SchoolYear::where('is_active', 1)->update(['is_active' => 0]);
            Session::put('active_year', $request->name);
        }

        $data                   = SchoolYear::find($id);
        $data->name             = $request->name;
        $data->even_period_from = $request->even_period_from;
        $data->even_period_to   = $request->even_period_to;
        $data->odd_period_from  = $request->odd_period_from;
        $data->odd_period_to    = $request->odd_period_to;
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
        $exec = SchoolYear::find($request->id);
        foreach ($exec->homeroom_teachers as $homeroom_teacher) {
            $homeroom_teacher->classRoomStudent()->delete();
        }
        $exec->homeroom_teachers()->delete();
        $exec->delete();
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
