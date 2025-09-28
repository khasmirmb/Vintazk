<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function agentPerformance()
    {
        $data = DB::table('agents')
            ->selectRaw('DATE_FORMAT(period, "%Y-%m") as month, AVG(overall_performance_rating) as avg_performance')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare arrays for chart
        $months = $data->pluck('month');
        $performance = $data->pluck('avg_performance');

        return view('home', compact('months', 'performance'));
    }
}

