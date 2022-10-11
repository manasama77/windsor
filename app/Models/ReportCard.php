<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'school_year_id',
        'period',
        'class_room_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function school_year()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function class_room_student()
    {
        return $this->belongsTo(ClassRoomStudent::class);
    }

    public function report_card_student()
    {
        return $this->hasMany(ReportCardStudent::class);
    }
}
