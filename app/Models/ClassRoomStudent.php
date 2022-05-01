<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomStudent extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'id',
        'homeroom_teacher_id',
        'student_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function homeroomTeacher()
    {
        return $this->belongsTo(HomeroomTeacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Student::class)->orderBy('name');
    }

    public function school_year()
    {
        return $this->hasManyThrough(SchoolYear::class, HomeroomTeacher::class, 'student_id');
    }
}
