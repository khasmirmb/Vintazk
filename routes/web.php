<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {

    // Agents Data
    $data = DB::table('agents')
        ->selectRaw('DATE_FORMAT(period, "%b %Y") as month, COALESCE(AVG(overall_performance_rating), 0) as avg_performance')
        ->groupBy('month')
        ->orderByRaw('MIN(period)')
        ->get();

    $agents_months = $data->pluck('month')->toArray();
    $agents_performance = $data->pluck('avg_performance')->map(function ($value) {
        return round($value, 0); // Round to no decimals
    })->toArray();

    $totalagents = DB::table('agents')
        ->selectRaw('COUNT(DISTINCT agent_name) as total_agents')
        ->value('total_agents');

    // Top 3 Agents
    $top_agents = DB::table('agents')
            ->select('agent_name', 'team', DB::raw('AVG(overall_performance_rating) as avg_performance_rating'))
            ->groupBy('agent_name', 'team')
            ->orderBy('avg_performance_rating', 'desc')
            ->limit(3)
            ->get();

    // Team Data
    $data = DB::table('teams')
        ->selectRaw('DATE_FORMAT(period, "%b %Y") as month, COALESCE(AVG(performance_rating), 0) as avg_performance')
        ->groupBy('month')
        ->orderByRaw('MIN(period)')
        ->get();

    $teams_months = $data->pluck('month')->toArray();
    $teams_performance = $data->pluck('avg_performance')->map(function ($value) {
        return round($value, 0); // Round to no decimals
    })->toArray();

    $totalteams = DB::table('teams')
        ->selectRaw('COUNT(DISTINCT name) as total_teams')
        ->value('total_teams');

    // Top 3 Teams
    $top_teams = DB::table('teams')
            ->select('name', 'team', DB::raw('AVG(performance_rating) as avg_performance_rating'))
            ->groupBy('name', 'team')
            ->orderBy('avg_performance_rating', 'desc')
            ->limit(3)
            ->get();

    // Metrics Data for Agent Analysis Chart (Attendance, KPI Performance, Behavior, Productivity and Overall)
    $metrics_data = DB::table('agents')
        ->selectRaw('DATE_FORMAT(period, "%b %Y") as month,
                     COALESCE(AVG(attendance), 0) as avg_attendance,
                     COALESCE(AVG(kpi_performance), 0) as avg_kpi,
                     COALESCE(AVG(behavior), 0) as avg_behavior,
                     COALESCE(AVG(productivity), 0) as avg_productivity,
                     COALESCE(AVG(overall_performance_rating), 0) as avg_overall')
        ->groupBy('month')
        ->orderByRaw('MIN(period)')
        ->get();

    $metrics_months = $metrics_data->pluck('month')->toArray();
    $avg_attendance = $metrics_data->pluck('avg_attendance')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_kpi = $metrics_data->pluck('avg_kpi')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_behavior = $metrics_data->pluck('avg_behavior')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_productivity = $metrics_data->pluck('avg_productivity')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_agent_overall = $metrics_data->pluck('avg_overall')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();

    // Metrics Data for Team Analysis Chart (Attendance, Team_KPI, Attrition and Overall)
    $teams_data = DB::table('teams')
        ->selectRaw('DATE_FORMAT(period, "%b %Y") as month,
                     COALESCE(AVG(attendance), 0) as avg_attendance,
                     COALESCE(AVG(team_kpi), 0) as avg_team_kpi,
                     COALESCE(AVG(attrition), 0) as avg_attrition,
                     COALESCE(AVG(performance_rating), 0) as avg_performance_rating')
        ->groupBy('month')
        ->orderByRaw('MIN(period)')
        ->get();

    $teams_months = $teams_data->pluck('month')->toArray();
    $avg_team_attendance = $teams_data->pluck('avg_attendance')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_team_kpi = $teams_data->pluck('avg_team_kpi')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_team_attrition = $teams_data->pluck('avg_attrition')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();
    $avg_team_performance = $teams_data->pluck('avg_performance_rating')->map(function ($value) {
        return number_format($value, 2, '.', '');
    })->toArray();

    // Overall Average for Agents
    $overall_avg_performance = DB::table('agents')
        ->selectRaw('COALESCE(AVG(overall_performance_rating), 0) as overall_avg_performance')
        ->value('overall_avg_performance');

    // Overall Average for Teams
    $overall_team_avg_performance = DB::table('teams')
        ->selectRaw('COALESCE(AVG(performance_rating), 0) as overall_team_avg_performance')
        ->value('overall_team_avg_performance');

        // Agents Calculate monthly differences
        $performance_differences = [];
        for ($i = 0; $i < count($agents_performance); $i++) {
            if ($i === 0) {
                $performance_differences[] = 0; // No previous month for the first entry
            } else {
                $difference = $agents_performance[$i] - $agents_performance[$i - 1];
                $performance_differences[] = number_format($difference, 2, '.', '');
            }
        }
        // Teams Calculate monthly differences
        $team_differences = [];
        for ($i = 0; $i < count($teams_performance); $i++) {
            if ($i === 0) {
                $team_differences[] = 0; // No previous month for the first entry
            } else {
                $difference = $teams_performance[$i] - $teams_performance[$i - 1];
                $team_differences[] = number_format($difference, 2, '.', '');
            }
        }

    return view('home', compact(
    'agents_months',
    'agents_performance',
    'totalagents',
    'top_agents',
    'teams_months',
    'teams_performance',
    'totalteams',
    'top_teams',
    'metrics_months',
    'avg_attendance',
    'avg_kpi',
    'avg_behavior',
    'avg_productivity',
    'avg_agent_overall',
    'avg_team_attendance',
    'avg_team_kpi',
    'avg_team_attrition',
    'avg_team_performance',
    'overall_avg_performance',
    'performance_differences',
    'overall_team_avg_performance',
    'team_differences'
    ));
});


Route::get('/agent', action: [AgentController::class, 'index'])->name('agent');
