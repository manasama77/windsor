<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class TeacherMeetingController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'page_title'    => "Management Pertemuan",
            'content_title' => "Management Pertemuan",
        ];
        return view('teacher.pertemuan.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'teacher.pertemuan.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
