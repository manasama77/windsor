<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\SetupTeacher;
use App\Models\SubjectGroup;
use Illuminate\Http\Request;

class AdminSetupGroupSubjectController extends Controller
{
    public function index()
    {
        $data = [
            'page_title'    => "Setup - Kelompok Mata Pelajaran",
            'content_title' => "Setup - Kelompok Mata Pelajaran",
        ];
        return view('admin.setup.kelompok_mapel.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = SubjectGroup::orderBy('id', 'desc');
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.setup.kelompok_mapel.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $subject_groups = SubjectGroup::create(['name' => $request->name]);

        if (!$subject_groups) {
            return back()->with('error', 'Create Failed');
        }

        return redirect()->route('admin.setup.kelompok.mapel')->with('success', 'Create Success');
    }

    public function destroy(Request $request)
    {
        $exec = SubjectGroup::find($request->id);
        $exec->delete();
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
