<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        // 1) Build the base query (define $query first)
        $query = DB::table('agents')
            ->select(
                'agent_name',
                'team',
                DB::raw('AVG(attendance) as avg_attendance'),
                DB::raw('AVG(kpi_performance) as avg_kpi_performance'),
                DB::raw('AVG(behavior) as avg_behavior'),
                DB::raw('AVG(ivp) as avg_ivp'),
                DB::raw('AVG(overall_performance_rating) as avg_performance_rating')
            );

        // 2) Apply search filter BEFORE groupBy / aggregation
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('agent_name', 'LIKE', "%{$search}%")
                  ->orWhere('team', 'LIKE', "%{$search}%");
            });
        }

        // 3) Finish query with grouping, ordering, pagination
        $agents = $query
            ->groupBy('agent_name', 'team')
            ->orderByDesc('avg_performance_rating')
            ->paginate(10)
            ->withQueryString(); // keep ?search= in pagination links

        // 4) Prepare monthly raw overall_performance_rating rows grouped by agent
        $monthlyPerformance = DB::table('agents')
            ->select(
                'agent_name',
                DB::raw("DATE_FORMAT(period, '%b %Y') as month"),
                'overall_performance_rating'
            )
            // apply same search constraint to monthly data so modal charts follow the filtered list
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where('agent_name', 'LIKE', "%{$s}%")
                  ->orWhere('team', 'LIKE', "%{$s}%");
            })
            ->orderBy('period', 'asc')
            ->get()
            ->groupBy('agent_name');

        return view('agent.index', compact('agents', 'monthlyPerformance'));
    }
}
