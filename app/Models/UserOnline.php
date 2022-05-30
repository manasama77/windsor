<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnline extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'meeting_id',
        'user_type',
        'user_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
