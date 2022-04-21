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
        'class_room_student_id',
        'title',
        'description',
        'is_task',
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

    public function class_room_student()
    {
        return $this->belongsTo(ClassRoomStudent::class);
    }
}
