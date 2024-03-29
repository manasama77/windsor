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
use Illuminate\Support\Facades\Session;
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

    public function datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['homeroomTeacher.schoolYear', 'teacher', 'homeroomTeacher.classRoom', 'subject'])->where('teacher_id', '=', Session::get('teacher_id'))->orderBy('id', 'desc')->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'teacher.pertemuan.action')
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

        $subjects = SetupTeacher::with('subject')->where('school_year_id', '=', $school_year->id)
            ->where('teacher_id', '=', Session::get('teacher_id'))->get();

        $data = [
            'page_title'       => "Management Pertemuan",
            'content_title'    => "Management Pertemuan",
            'school_year'      => $school_year,
            'setupTeachers'    => $setupTeachers,
            'homeRoomTeachers' => $homeRoomTeachers,
            'subjects'         => $subjects,
        ];
        return view('teacher.pertemuan.form', $data);
    }

    protected function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $meeting                      = new Meeting();
        $meeting->teacher_id          = Session::get('teacher_id');
        $meeting->subject_id          = $request->subject_id;
        $meeting->homeroom_teacher_id = $request->homeroom_teacher_id;
        $meeting->active_date         = $request->active_date;
        $meeting->title               = $request->title;
        $meeting->description         = strip_tags(trim(nl2br($request->description)));
        $meeting->is_task             = $request->is_task;
        if ($request->is_task == 1) {
            $meeting->from_period         = $request->from_period;
            $meeting->to_period           = $request->to_period;
        }
        if ($meeting->save() === false) {
            DB::rollBack();
            dd($meeting->save());
            return response()->json(['code' => 500], 500);
        }
        $meeting_id = $meeting->id;
        $file = $request->file('files' . 0);
        $folder_name = $this->clean(Auth::guard('teacher')->user()->id . "-" . Auth::guard('teacher')->user()->name);
        // dd($folder_name);

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->hashName();

                    $folder_name = $this->clean(Auth::guard('teacher')->user()->id . "-" . Auth::guard('teacher')->user()->name);
                    $path = $file->storeAs($folder_name, $name, 'public');
                    // Storage::makeDirectory($folder_name,);
                    // $path = Storage::putFileAs('public/' . $folder_name, $file, $name);

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

    public function edit($meeting_id)
    {
        $meetings             = Meeting::where('id', '=', $meeting_id)->first();
        $meetingAttachments   = MeetingAttachment::where('meeting_id', '=', $meeting_id)->get();
        $meetingLinkExternals = MeetingLinkExternal::where('meeting_id', '=', $meeting_id)->get();
        $setupTeachers        = SetupTeacher::with(['teacher' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->get();

        $school_year = SchoolYear::where('is_active', '=', 1)->first();

        $homeRoomTeachers = HomeroomTeacher::with('classRoom')->where('school_year_id', '=', $school_year->id)->get();

        $subjects = SetupTeacher::with('subject')->where('school_year_id', '=', $school_year->id)
            ->where('teacher_id', '=', Session::get('teacher_id'))->get();

        $data = [
            'page_title'           => "Management Pertemuan",
            'content_title'        => "Management Pertemuan",
            'meeting_id'           => $meeting_id,
            'meetings'             => $meetings,
            'meetingAttachments'   => $meetingAttachments,
            'meetingLinkExternals' => $meetingLinkExternals->toJson(),
            'setupTeachers'        => $setupTeachers,
            'homeRoomTeachers'     => $homeRoomTeachers,
            'subjects'             => $subjects,
            'school_year'          => $school_year,
        ];
        return view('teacher.pertemuan.form_edit', $data);
    }

    public function update(Request $request, $meeting_id)
    {
        DB::beginTransaction();
        $meeting = Meeting::find($meeting_id);
        // $meeting->teacher_id          = $request->teacher_id;
        $meeting->subject_id          = $request->subject_id;
        $meeting->homeroom_teacher_id = $request->homeroom_teacher_id;
        $meeting->active_date         = $request->active_date;
        $meeting->title               = $request->title;
        $meeting->description         = $request->description;
        $meeting->is_task             = $request->is_task;
        if (!$meeting->save()) {
            DB::rollBack();
            return response()->json(['code' => 500], 500);
        }

        $old_attachment_collection = collect($request->old_attachment);

        if ($old_attachment_collection->count() > 0) {
            $attcCollection     = collect();
            $meetingAttachments = MeetingAttachment::select('id')->where('meeting_id', '=', $meeting_id)->get();

            foreach ($meetingAttachments as $key) {
                $attcCollection->push($key->id);
            }

            $diffAttachment = $attcCollection->diff($old_attachment_collection);

            foreach ($diffAttachment->all() as $key => $val) {
                $a = MeetingAttachment::select(['id', 'path'])->where('id', '=', $val)->first();
                if ($a->count() > 0) {
                    Storage::delete('public/' . $a->path);
                    if (!MeetingAttachment::find($a->id)->delete()) {
                        DB::rollBack();
                        return response()->json(['code' => 500], 500);
                    }
                }
            }
        }

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->hashName();

                    $folder_name = Auth::guard('teacher')->user()->id . "-" . Auth::guard('teacher')->user()->name;
                    // $path = $file->storeAs($folder_name, $name, 'public');
                    $path = Storage::putFileAs('public/' . $folder_name, $file, $name);

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
                MeetingLinkExternal::where('meeting_id', '=', $meeting_id)->delete();
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

    public function destroy(Request $request)
    {
        $exec = Meeting::with(['attachment', 'linkExternal'])->find($request->id);

        if ($exec->attachment->count() > 0) {
            foreach ($exec->attachment as $a) {
                Storage::delete('public/' . $a->path);
            }
        }

        $exec->delete();
        return response()->json([
            'code' => 200,
            'msg'  => 'Hapus Data berhasil'
        ]);
    }
}
