<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Chat;
use App\Models\Meeting;
use App\Models\Student;
use App\Models\UserOnline;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentChatController extends Controller
{

    public function index($chatToken)
    {
        $meeting_id    = $this->meeting_user_id($chatToken, "meeting");
        $student_id    = $this->meeting_user_id($chatToken, "student");
        $data_chatroom = $this->validate_meeting($meeting_id, $student_id);
        $data  = compact('chatToken', 'meeting_id', 'student_id', 'data_chatroom');
        return view('chat.main', $data);
    }

    public function verify($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $student_id = $this->meeting_user_id($chatToken, "student");

        $tgl_obj = new DateTime();
        $tgl_obj->modify('+1 minute');

        // dd($tgl_obj->format('Y-m-d H:i:s'));

        UserOnline::updateOrCreate(
            ['meeting_id' => $meeting_id, 'user_type' => 'student', 'user_id' => $student_id],
            ['updated_at' => $tgl_obj->format('Y-m-d H:i:s')]
        );
        return redirect()->route('student.chat', $chatToken);
    }

    public function online($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $student_id = $this->meeting_user_id($chatToken, "student");
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
        $student_id = $this->meeting_user_id($chatToken, "student");
        $tgl_obj    = new DateTime();
        $tgl_obj->modify('+1 minute');
        $exec = UserOnline::where([
            'meeting_id' => $meeting_id,
            'user_type'  => 'student',
            'user_id'    => $student_id,
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
        $student_id = $this->meeting_user_id($chatToken, "student");
        $message    = $request->message;

        $chat = new Chat();
        $chat->id = Str::uuid();
        $chat->meeting_id = $meeting_id;
        $chat->user_type = "student";
        $chat->user_id = $student_id;
        $chat->message = nl2br($message);


        if (!$chat->save()) return response()->json(['code' => 500], 500);

        return response()->json(['code' => 200], 200);
    }

    public function render($chatToken)
    {
        $meeting_id = $this->meeting_user_id($chatToken, "meeting");
        $student_id = $this->meeting_user_id($chatToken, "student");


        $exec = Chat::select(DB::raw('
            IF(
                chats.user_type = "student",
                (select `name` from students where students.id = chats.user_id),
                (select `name` from teachers where teachers.id = chats.user_id)
            ) as `name`,
            IF(
                chats.user_type = "student" AND chats.user_id = ' . $student_id . ',
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

    protected function validate_meeting($meeting_id, $student_id)
    {
        $meetings = Meeting::where('id', '=', $meeting_id)->first();
        if (!$meetings) return view('chat.page_404', ['message' => 'Meeting Chat Room Not Found']);

        $students = Student::where('id', '=', $student_id)->first();
        if (!$students) return view('chat.page_404', ['message' => '[401] Unautorize']);

        $return = [
            'meeting_title' => $meetings->title,
            'student_name'  => $students->name,
        ];

        return $return;
    }

    protected function meeting_user_id($chatToken, $type = null)
    {
        if (!$type) return false;
        $chatToken  = base64_decode($chatToken);
        $explode    = explode(":", $chatToken);
        $meeting_id = $explode[0];
        $student_id = $explode[1];

        if ($type == "meeting") {
            return $meeting_id;
        } else {
            return $student_id;
        }
    }
}
