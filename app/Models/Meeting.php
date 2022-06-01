<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'homeroom_teacher_id',
        'active_date',
        'title',
        'description',
        'is_task',
        'from_period',
        'to_period',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(HomeroomTeacher::class);
    }

    public function attachment()
    {
        return $this->hasMany(MeetingAttachment::class);
    }

    public function linkExternal()
    {
        return $this->hasMany(MeetingLinkExternal::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
