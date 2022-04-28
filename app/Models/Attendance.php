<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'student_id',
        'status_presence',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
