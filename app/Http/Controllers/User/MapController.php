<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MonsterSightings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function index(){
        $monsters = MonsterSightings::all();
        return view('user.map', compact('monsters'));
    }
}
