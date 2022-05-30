<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_type',
        'user_id',
        'message',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function getIncrementing()
    {
        return false;
    }
}
