<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    
    protected $fillable = [
        'schedule_date',
        'package_type',
        'quota',
        'filled',
        'is_active'
    ];

    protected $casts = [
        'schedule_date' => 'date'
    ];
}