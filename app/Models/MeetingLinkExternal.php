<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingLinkExternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'url',
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
