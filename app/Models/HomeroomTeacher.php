<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeroomTeacher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_year_id',
        'class_room_id',
        'teacher_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function classRoomStudent()
    {
        return $this->hasMany(ClassRoomStudent::class);
    }
}
