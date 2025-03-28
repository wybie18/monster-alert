<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MonsterSightings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get total sightings
        $totalSightings = MonsterSightings::count();
        
        // Get user's sightings
        $userSightings = MonsterSightings::where('user_id', Auth::id())->count();
        
        // Get recent sightings (last 24 hours)
        $recentSightings = MonsterSightings::where('created_at', '>=', Carbon::now()->subDay())->count();
        
        // Get nearby sightings (placeholder - would need user's location)
        // For now, we'll just get the 5 most recent for the map preview
        $nearbyMonsters = MonsterSightings::latest()->take(5)->get();
        $nearbySightings = $nearbyMonsters->count();
        
        // Get recent monsters for the list
        $recentMonsters = MonsterSightings::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        // Get user's monsters
        $userMonsters = MonsterSightings::where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();
        
        // Get monster type distribution
        $monsterTypes = MonsterSightings::select('monster_type', DB::raw('count(*) as count'))
            ->groupBy('monster_type')
            ->pluck('count', 'monster_type')
            ->toArray();
        
        return view('user.dashboard', compact(
            'totalSightings',
            'userSightings',
            'recentSightings',
            'nearbySightings',
            'nearbyMonsters',
            'recentMonsters',
            'userMonsters',
            'monsterTypes'
        ));
    }
}
