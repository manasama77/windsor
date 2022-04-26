<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\SchoolYear;
use App\Models\SetupTeacher;
use Illuminate\Http\Request;
use App\Models\HomeroomTeacher;
use App\Models\MeetingAttachment;
use Illuminate\Support\Facades\DB;
use App\Models\MeetingLinkExternal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherMeetingController extends Controller
{
    public function index()
    {
        $data = [
            'page_title'    => "Management Pertemuan",
            'content_title' => "Management Pertemuan",
        ];
        return view('teacher.pertemuan.main', $data);
    }

    public function test()
    {
        $file = MeetingAttachment::find(2);
        // $lampiran = Storage::disk('local')->get($file->path);
        // $temp = $file->name;
        // $mime = $file->mime;
        // file_put_contents($temp, $lampiran);
        // header("Content-type: $mime");
        // header("Content-Length: " . filesize($temp));
        // readfile($temp);

        // return response($lampiran, 200)->header('Content-Type', $file->mime);

        // return Storage::download($file->path, $file->name, [
        //     'Content-Type' => $file->mime
        // ]);

        // dd(storage_path());

        return response()->download('storage/' . $file->path, $file->name);
    }

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['homeroomTeacher.schoolYear', 'teacher', 'homeroomTeacher.classRoom', 'subject'])->orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'teacher.pertemuan.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show_subject($teacher_id)
    {
        $subjects = SetupTeacher::with(['subject' => function ($query) {
            $query->where('is_active', '=', 1);
        }])->where('teacher_id', '=', $teacher_id)->get();
        return response()->json($subjects);
    }

    public function add()
    {
        $setupTeachers = SetupTeacher::with(['teacher' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->get();

        $school_year = SchoolYear::where('is_active', '=', 1)->first();

        $homeRoomTeachers = HomeroomTeacher::with('classRoom')->where('school_year_id', '=', $school_year->id)->get();

        $data = [
            'page_title'       => "Management Pertemuan",
            'content_title'    => "Management Pertemuan",
            'setupTeachers'    => $setupTeachers,
            'homeRoomTeachers' => $homeRoomTeachers,
        ];
        return view('teacher.pertemuan.form', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $meeting                      = new Meeting();
        $meeting->teacher_id          = $request->teacher_id;
        $meeting->subject_id          = $request->subject_id;
        $meeting->homeroom_teacher_id = $request->homeroom_teacher_id;
        $meeting->title               = $request->title;
        $meeting->description         = $request->description;
        $meeting->is_task             = $request->is_task;
        if (!$meeting->save()) {
            DB::rollBack();
            return response()->json(['code' => 500], 500);
        }
        $meeting_id = $meeting->id;

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->hashName();

                    $folder_name = Auth::guard('teacher')->user()->id . "-" . Auth::guard('teacher')->user()->name;
                    $path = $file->storeAs($folder_name, $name, 'public');

                    $meetingAttachment = new MeetingAttachment();
                    $meetingAttachment->meeting_id = $meeting_id;
                    $meetingAttachment->name = $file->getClientOriginalName();
                    $meetingAttachment->path = $path;
                    $meetingAttachment->mime = $file->getMimeType();
                    if (!$meetingAttachment->save()) {
                        DB::rollBack();
                        return response()->json(['code' => 500], 500);
                    }
                }
            }
        }

        if ($request->link) {
            if (count($request->link) > 0) {
                for ($i = 0; $i < count($request->link); $i++) {
                    $meetingUrl             = new MeetingLinkExternal();
                    $meetingUrl->meeting_id = $meeting_id;
                    $meetingUrl->url        = $request->link[$i];
                    if (!$meetingUrl->save()) {
                        DB::rollBack();
                        return response()->json(['code' => 500], 500);
                    }
                }
            }
        }

        DB::commit();
        return response()->json(['code' => 200], 200);
    }

    public function truncate()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Meeting::truncate();
        MeetingAttachment::truncate();
        MeetingLinkExternal::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return "OK";
    }
}
