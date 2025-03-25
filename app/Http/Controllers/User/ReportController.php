<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MonsterSightings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(){
        return view('user.report');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'monster_type' => 'required|string|max:255',
            'description'  => 'required|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        $imagePath = $request->file('image')->store('monster_images', 'public');

        MonsterSightings::create([
            'user_id'      => Auth::id(),
            'name'         => $validated['name'],
            'image'        => $imagePath,
            'monster_type' => $validated['monster_type'],
            'description'  => $validated['description'],
            'latitude'     => $validated['latitude'],
            'longitude'    => $validated['longitude'],
            'approved_by'  => null,
            'approved_at'  => null,
        ]);

        return redirect()->route('user.report')->with('success', 'Monster reported!');
    }
}
