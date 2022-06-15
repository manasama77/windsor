<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meeting;
use App\Models\StudentWork;
use Illuminate\Http\Request;
use App\Models\MeetingAttachment;
use Illuminate\Routing\Controller;
use App\Models\MeetingLinkExternal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class StudentMeetingController extends Controller
{

    public function index(Request $request)
    {
        $meetings = Meeting::with(['homeroomTeacher.schoolYear', 'teacher', 'homeroomTeacher.classRoom', 'subject'])
            ->where('homeroom_teacher_id', '=', Session::get('homeroom_teacher_id'))
            ->orderBy('id', 'desc')
            ->get();

        $data = [
            'page_title'    => "Pertemuan",
            'content_title' => "Pertemuan",
            'meetings'      => $meetings,
        ];
        return view('student.pertemuan.main', $data);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['homeroomTeacher.schoolYear', 'teacher', 'homeroomTeacher.classRoom', 'subject'])
                ->where('homeroom_teacher_id', '=', Session::get('homeroom_teacher_id'))
                ->orderBy('id', 'desc')
                ->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'student.pertemuan.action')
                ->make(true);
        }
    }

    public function show($meeting_id)
    {
        $meetings = Meeting::with('attendance')->where('id', '=', $meeting_id)->first();

        if (!$meetings) {
            return view('student.not_found_meeting');
        }

        if (Carbon::now() <= $meetings->active_date) {
            $active_date = Carbon::parse($meetings->active_date)->locale('id');
            $active_date->settings(['formatFunction' => 'translatedFormat']);
            $data = ['active_date' => $active_date->format('l, j F Y')];
            return view('student.restriction_meeting', $data);
        }

        if (Session::get('homeroom_teacher_id') != $meetings->homeroom_teacher_id) {
            return view('student.unautorize_meeting');
        }

        $meeting_attachments    = MeetingAttachment::where('meeting_id', '=', $meeting_id)->get();
        $meeting_link_externals = MeetingLinkExternal::where('meeting_id', '=', $meeting_id)->get();
        $student_works          = StudentWork::where('meeting_id', '=', $meeting_id)->where('student_id', '=', Session::get('student_id'))->first();

        $can_upload  = false;
        $from_period = null;
        $to_period   = null;

        if ($meetings->from_period) {
            $current_period = Carbon::now();
            $from_period    = Carbon::createFromFormat('Y-m-d H:i:s', $meetings->from_period);
            $to_period      = Carbon::createFromFormat('Y-m-d H:i:s', $meetings->to_period);
            $can_upload     = $current_period->gte($from_period);
            $can_upload     = $current_period->lte($to_period);
        }

        $chatToken = base64_encode($meeting_id . ":" . Session::get('student_id'));

        $data = [
            'page_title'             => "Detail Pertemuan",
            'meetings'               => $meetings,
            'meeting_attachments'    => $meeting_attachments,
            'meeting_link_externals' => $meeting_link_externals,
            'student_works'          => $student_works,
            'can_upload'             => $can_upload,
            'from_period'            => $from_period,
            'to_period'              => $to_period,
            'chatToken'              => $chatToken,
        ];
        return view('student.pertemuan.show', $data);
    }

    public function download($attachment_id)
    {
        $file = MeetingAttachment::find($attachment_id);
        if (!$file) return abort(401);
        return response()->download('storage/' . $file->path, $file->name, [
            'Content-Type' => $file->mime
        ]);
    }

    public function upload(Request $request, $meeting_id)
    {
        $sw = StudentWork::where('meeting_id', '=', $meeting_id)->where('student_id', '=', Session::get('student_id'))->first();
        if ($sw != null) {
            $fp = $sw->file_path;
            Storage::delete('public/' . $fp);
        }

        $file = $request->file('file');
        $name = $file->hashName();

        $folder_name = 'siswa/' . Auth::guard('student')->user()->id . "-" . Auth::guard('student')->user()->name;
        $path = $file->storeAs($folder_name, $name, 'public');
        $exec = StudentWork::updateOrCreate(
            ['meeting_id' => $meeting_id, 'student_id' => Session::get('student_id')],
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
        if (!$file) return abort(401);
        return response()->download('storage/' . $file->file_path, $file->file_name, [
            'Content-Type' => $file->mime
        ]);
    }
}
