<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'type_attachment',
        'title',
        'file_path',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
