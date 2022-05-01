<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\ClassRoomStudent;
use App\Models\MeetingAttachment;
use App\Models\MeetingLinkExternal;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentMeetingController extends Controller
{
    protected $class_id;
    protected $homeroom_teacher_id;

    public function __construct()
    {
        $this->class_id = Session::get('class_id');
        $this->homeroom_teacher_id = Session::get('homeroom_teacher_id');
    }

    public function index()
    {
        $data = [
            'page_title'    => "Pertemuan",
            'content_title' => "Pertemuan",
        ];
        return view('student.pertemuan.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['homeroomTeacher.schoolYear', 'teacher', 'homeroomTeacher.classRoom', 'subject'])
                ->where('homeroom_teacher_id', '=', $this->homeroom_teacher_id)
                ->orderBy('id', 'desc')
                ->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'student.pertemuan.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($meeting_id)
    {
        $meetings               = Meeting::with('attendance')->find($meeting_id)->first();
        $meeting_attachments    = MeetingAttachment::where('meeting_id', '=', $meeting_id)->get();
        $meeting_link_externals = MeetingLinkExternal::where('meeting_id', '=', $meeting_id)->get();
        $data = [
            'page_title'             => "Detail Pertemuan",
            'content_title'          => "Detail Pertemuan",
            'meetings'               => $meetings,
            'meeting_attachments'    => $meeting_attachments,
            'meeting_link_externals' => $meeting_link_externals,
        ];
        return view('student.pertemuan.show', $data);
    }

    public function download($attachment_id)
    {
        $file = MeetingAttachment::find($attachment_id);
        return response()->download('storage/' . $file->path, $file->name);
    }
}
