<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        // 1) Build the base query (define $query first)
        $query = DB::table('teams')
            ->select(
                'name',
                'team',
                DB::raw('AVG(attendance) as avg_attendance'),
                DB::raw('AVG(team_kpi) as avg_kpi_performance'),
                DB::raw('AVG(attrition) as avg_behavior'),
                DB::raw('AVG(ivp) as avg_ivp'),
                DB::raw('AVG(performance_rating) as avg_performance_rating')
            );

        // 2) Apply search filter BEFORE groupBy / aggregation
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('team', 'LIKE', "%{$search}%");
            });
        }

        // 3) Finish query with grouping, ordering, pagination
        $teams = $query
            ->groupBy('name', 'team')
            ->orderByDesc('avg_performance_rating')
            ->paginate(10)
            ->withQueryString(); // keep ?search= in pagination links

        // 4) Prepare monthly raw performance_rating rows grouped by team
        $monthlyPerformance = DB::table('teams')
            ->select(
                'name',
                DB::raw("DATE_FORMAT(period, '%b %Y') as month"),
                'performance_rating'
            )
            // apply same search constraint to monthly data so modal charts follow the filtered list
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where('name', 'LIKE', "%{$s}%")
                  ->orWhere('team', 'LIKE', "%{$s}%");
            })
            ->orderBy('period', 'asc')
            ->get()
            ->groupBy('name');

        return view('team.index', compact('teams', 'monthlyPerformance'));
    }
}
