<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Chat;
use App\Models\Meeting;
use App\Models\Teacher;
use App\Models\UserOnline;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherChatController extends Controller
{
    public function index($chatToken)
    {
        $meeting_id    = $this->meeting_user_id($chatToken, "meeting");
        $teacher_id    = $this->meeting_user_id($chatToken, "teacher");
        $data_chatroom = $this->validate_meeting($meeting_id, $teacher_id);
        $data  = compact('chatToken', 'meeting_id', 'data_chatroom');
        return view('chat.main_teacher', $data);
    }

    public function verify($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $teacher_id = $this->meeting_user_id($chatToken, "teacher");

        $tgl_obj = new DateTime();
        $tgl_obj->modify('+1 minute');

        UserOnline::updateOrCreate(
            ['meeting_id' => $meeting_id, 'user_type' => 'teacher', 'user_id' => $teacher_id],
            ['updated_at' => $tgl_obj->format('Y-m-d H:i:s')]
        );
        return redirect()->route('teacher.chat', $chatToken);
    }

    public function online($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $tgl_obj    = new DateTime();
        $user_online_student = UserOnline::select(['students.name'])
            ->leftJoin('students', 'students.id', '=', 'user_onlines.user_id')
            ->where([
                'user_onlines.meeting_id' => $meeting_id,
                'user_onlines.user_type'  => 'student'
            ])
            ->where('user_onlines.updated_at', '>=', $tgl_obj->format('Y-m-d H:i:s'))
            ->get();

        $user_online_teacher = UserOnline::select(['teachers.name'])
            ->leftJoin('teachers', 'teachers.id', '=', 'user_onlines.user_id')
            ->where([
                'user_onlines.meeting_id' => $meeting_id,
                'user_onlines.user_type'  => 'teacher'
            ])
            ->where('user_onlines.updated_at', '>=', $tgl_obj->format('Y-m-d H:i:s'))
            ->get();

        return response()->json([
            'code'                => 200,
            'user_online_teacher' => $user_online_teacher,
            'user_online_student' => $user_online_student,
        ], 200);
    }

    public function set_online($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $teacher_id = $this->meeting_user_id($chatToken, "teacher");
        $tgl_obj    = new DateTime();
        $tgl_obj->modify('+1 minute');
        $exec = UserOnline::where([
            'meeting_id' => $meeting_id,
            'user_type'  => 'teacher',
            'user_id'    => $teacher_id,
        ])->update([
            'updated_at' => $tgl_obj->format('Y-m-d H:i:s')
        ]);
        if ($exec) {
            return response()->json(['code' => 200], 200);
        } else {
            return response()->json(['code' => 500], 500);
        }
    }

    public function send($chatToken, Request $request)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $teacher_id = $this->meeting_user_id($chatToken, "teacher");
        $message    = strip_tags($request->message);

        $chat             = new Chat();
        $chat->id         = Str::uuid();
        $chat->meeting_id = $meeting_id;
        $chat->user_type  = "teacher";
        $chat->user_id    = $teacher_id;
        $chat->message    = nl2br($message);

        if (!$chat->save()) return response()->json(['code' => 500], 500);

        return response()->json(['code' => 200], 200);
    }

    public function render($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $teacher_id = $this->meeting_user_id($chatToken, "teacher");

        $exec = Chat::select(DB::raw('
            IF(
                chats.user_type = "student",
                (select `name` from students where students.id = chats.user_id),
                (select `name` from teachers where teachers.id = chats.user_id)
            ) as `name`,
            IF(
                chats.user_type = "teacher" AND chats.user_id = ' . $teacher_id . ',
                "right",
                "left"
            ) as align,
            chats.user_type,
            chats.message,
            chats.created_at
        '))->where('chats.meeting_id', '=', $meeting_id)->orderBy('chats.created_at', 'asc')->get();

        if (!$exec) return response()->json(['code' => 500], 500);

        return response()->json([
            'code' => 200,
            'data' => $exec
        ], 200);
    }

    protected function validate_meeting($meeting_id, $teacher_id)
    {
        $meetings = Meeting::where('id', '=', $meeting_id)->first();
        if (!$meetings) return view('chat.page_404', ['message' => 'Meeting Chat Room Not Found']);

        $teachers = Teacher::where('id', '=', $teacher_id)->first();
        if (!$teachers) return view('chat.page_404', ['message' => '[401] Unautorize']);

        $return = [
            'meeting_title' => $meetings->title,
            'teacher_name'  => $teachers->name,
        ];

        return $return;
    }

    protected function meeting_user_id($chatToken, $type = null)
    {
        if (!$type) return false;
        $chatToken  = base64_decode($chatToken);
        $explode    = explode(":", $chatToken);
        $meeting_id = $explode[0];
        $teacher_id = $explode[1];

        if ($type == "meeting") {
            return $meeting_id;
        } else {
            return $teacher_id;
        }
    }
}
