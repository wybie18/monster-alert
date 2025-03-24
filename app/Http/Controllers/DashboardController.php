<?php

namespace App\Http\Controllers;

use App\Models\MonsterSightings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total approved sightings
        $totalSightings = MonsterSightings::whereNotNull('approved_by')->count();

        // Pending submissions
        $pendingSubmissions = MonsterSightings::whereNull('approved_by')->count();

        // Unique monster types
        $uniqueMonsterTypes = MonsterSightings::whereNotNull('approved_by')
            ->select('monster_type')
            ->distinct()
            ->count();

        // Recent sightings (approved)
        $recentSightings = MonsterSightings::whereNotNull('approved_by')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent submissions (pending)
        $recentSubmissions = MonsterSightings::whereNull('approved_by')
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalSightings', 
            'pendingSubmissions', 
            'uniqueMonsterTypes', 
            'recentSightings', 
            'recentSubmissions'
        ));
    }
}
