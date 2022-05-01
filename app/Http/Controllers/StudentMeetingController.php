<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meeting;
use App\Models\StudentWork;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MeetingAttachment;
use Illuminate\Routing\Controller;
use App\Models\MeetingLinkExternal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentMeetingController extends Controller
{
    protected $student_id;
    protected $class_id;
    protected $homeroom_teacher_id;

    public function __construct()
    {
        $this->student_id          = Auth::guard('student')->user()->id;
        $this->class_id            = Session::get('class_id');
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
        $student_works          = StudentWork::where('meeting_id', '=', $meeting_id)->where('student_id', '=', $this->student_id)->first();

        $current_period = Carbon::now();
        $from_period    = Carbon::createFromFormat('Y-m-d H:i:s', $meetings->from_period);
        $to_period      = Carbon::createFromFormat('Y-m-d H:i:s', $meetings->to_period);

        $can_upload = $current_period->gte($from_period);
        $can_upload = $current_period->lte($to_period);

        $data = [
            'page_title'             => "Detail Pertemuan",
            'content_title'          => "Detail Pertemuan",
            'meetings'               => $meetings,
            'meeting_attachments'    => $meeting_attachments,
            'meeting_link_externals' => $meeting_link_externals,
            'student_works'          => $student_works,
            'can_upload'             => $can_upload,
            'from_period'            => $from_period,
            'to_period'              => $to_period,
        ];
        return view('student.pertemuan.show', $data);
    }

    public function download($attachment_id)
    {
        $file = MeetingAttachment::find($attachment_id);
        return response()->download('storage/' . $file->path, $file->name);
    }

    public function upload(Request $request, $meeting_id)
    {
        $sw = StudentWork::where('meeting_id', '=', $meeting_id)->where('student_id', '=', $this->student_id)->first();
        if ($sw != null) {
            $fp = $sw->file_path;
            Storage::delete('public/' . $fp);
        }


        $file = $request->file('file');
        $name = $file->hashName();

        $folder_name = 'siswa/' . Auth::guard('teacher')->user()->id . "-" . Auth::guard('teacher')->user()->name;
        $path = $file->storeAs($folder_name, $name, 'public');
        $exec = StudentWork::updateOrCreate(
            ['meeting_id' => $meeting_id, 'student_id' => $this->student_id],
            ['file_name' => $file->getClientOriginalName(), 'file_path' => $path, 'mime' => $file->getMimeType()]
        );

        if ($exec) {
            return redirect('student/pertemuan/show/' . $meeting_id)->with('success', 'Upload Tugas Berhasil');
        } else {
            return redirect('student/pertemuan/show/' . $meeting_id)->with('error', 'Upload Tugas Gagal');
        }
    }

    public function download_tugas($id)
    {
        $file = StudentWork::find($id);
        return response()->download('storage/' . $file->file_path, $file->file_name);
    }
}
