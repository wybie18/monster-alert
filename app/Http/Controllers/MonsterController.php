<?php
namespace App\Http\Controllers;

use App\Models\MonsterSightings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonsterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monsters = MonsterSightings::whereNotNull('approved_by')->get();

        return view('admin.monsters.monsters', compact('monsters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.monsters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('monsters.index')->with('success', 'Sighting submitted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $monster = MonsterSightings::findOrFail($id);
        return view('admin.monsters.show', compact('monster'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $monster = MonsterSightings::findOrFail($id);
        return view('admin.monsters.edit', compact('monster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $monster = MonsterSightings::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'monster_type' => 'required|string|max:255',
            'description'  => 'required|string',
            'latitude'     => 'required|numeric',
            'longitude'    => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $monster->image);
            $imagePath          = $request->file('image')->store('monster_images', 'public');
            $validated['image'] = $imagePath;
        }

        $monster->update($validated);

        return redirect()->route('monsters.index')->with('success', 'Sighting updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $submission = MonsterSightings::findOrFail($id);
        $submission->delete();

        return redirect()->route('monsters.index')->with('success', 'Sighting deleted!');
    }
}
