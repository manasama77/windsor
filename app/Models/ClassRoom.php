<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
        'classroom_type',
        'vocational_type',
    ];

    public function homeroom_teacher()
    {
        return $this->hasMany(HomeroomTeacher::class);
    }

    public function homeroom_teacher_with_class_room()
    {
        return $this->homeroom_teacher()->with(ClassRoom::class);
    }
}
