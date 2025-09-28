<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';

    protected $fillable = [
        'agent_name',
        'team',
        'quiz',
        'productivity',
        'timeliness',
        'attendance',
        'kpi_performance',
        'behavioral',
        'behavior',
        'ivp',
        'overall_performance_rating',
        'period',
    ];
}
