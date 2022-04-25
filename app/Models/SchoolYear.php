<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolYear extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'even_period_from',
        'even_period_to',
        'to_period_from',
        'to_period_to',
        'is_active',
    ];

    public function homeroom_teachers()
    {
        return $this->hasMany(HomeroomTeacher::class);
    }

    public function setup_teachers()
    {
        return $this->hasMany(SetupTeacher::class);
    }
}
