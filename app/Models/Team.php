<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'team',
        'attendance',
        'team_kpi',
        'attrition',
        'ivp',
        'performance_rating',
        'period',
    ];
}
