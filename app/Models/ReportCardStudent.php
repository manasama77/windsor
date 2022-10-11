<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCardStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'report_card_id',
        'student_id',
        'subject_id',
        'score',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function report_card()
    {
        return $this->belongsTo(ReportCard::class);
    }
}
