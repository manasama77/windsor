<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'subject_group_id',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function subject_group()
    {
        return $this->belongsTo(SubjectGroup::class);
    }

    public function setup_teacher()
    {
        return $this->hasMany(SetupTeacher::class);
    }

    public function meeting()
    {
        return $this->hasMany(Meeting::class);
    }
}
