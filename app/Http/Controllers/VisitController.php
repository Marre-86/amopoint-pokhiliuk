<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\Log;

class VisitController extends Controller
{
    /**
     * Display dashboard view with chart data.
     */
    public function dashboard()
    {
        // Get visits from last 24 hours - fetch all at once
        $last24Hours = now()->subHours(24);
        $visitsLast24Hours = Visit::where('created_at', '>=', $last24Hours)->get();

        // Line chart data: visits per hour for last 24 hours as time series
        $hourlyVisits = [];
        $hourLabels = [];

        $currentHour = (int) now()->format('H');

        // Generate 24 hours: from (current hour - 23) to current hour
        for ($i = -23; $i <= 0; $i++) {
            $hour = $currentHour + $i;
            if ($hour < 0) {
                $hour += 24;
            } elseif ($hour >= 24) {
                $hour -= 24;
            }

            $hourStart = now()->addHours($i)->startOfHour();
            $hourEnd = now()->addHours($i)->endOfHour();

            $count = $visitsLast24Hours->filter(function ($visit) use ($hourStart, $hourEnd) {
                return $visit->created_at >= $hourStart && $visit->created_at <= $hourEnd;
            })->count();

            $hourlyVisits[] = $count;
            $hourLabels[] = str_pad($hour, 2, '0', STR_PAD_LEFT);
        }

        // Pie chart data: visits by city
        $cityVisits = Visit::where('created_at', '>=', $last24Hours)
            ->selectRaw('city, COUNT(*) as count')
            ->groupBy('city')
            ->orderByDesc('count')
            ->limit(10) // Top 10 cities
            ->get()
            ->map(function ($item) {
                return [
                    'city' => $item->city ?: 'Unknown',
                    'count' => $item->count
                ];
            });

        $pieLabels = $cityVisits->pluck('city')->toArray();
        $pieData = $cityVisits->pluck('count')->toArray();

        $totalVisits = array_sum($hourlyVisits);

        return view('dashboard', [
            'line_chart_labels' => $hourLabels,
            'line_chart_data' => $hourlyVisits,
            'pie_chart_labels' => $pieLabels,
            'pie_chart_data' => $pieData,
            'total_visits' => $totalVisits,
            'last_updated' => now()->format('d.m.Y H:i:s'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data (all fields are optional)
        $validated = $request->validate([
            'ip_address' => 'nullable|string|max:45',
            'city' => 'nullable|string|max:100',
            'device' => 'nullable|string|max:255',
        ]);

        $visit = Visit::create($validated);

        return response()->json([
            'message' => 'Visit recorded successfully',
            'visit' => $visit,
        ], 201);
    }
}
