<?php

namespace App\Http\Controllers;

use App\Models\MonsterSightings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index(){
        $submissions = MonsterSightings::whereNull('approved_by')->get();
        return view('admin.submissions.submissions', compact('submissions'));
    }

    public function approve(string $id){
        $submission = MonsterSightings::findOrFail($id);

        if ($submission->approved_at) {
            return redirect()->back()->with('error', 'Submission already approved');
        }

        $submission->update([
            'approved_at' => now(),
            'approved_by' => Auth::id(),
        ]);
        
        return redirect()->route('submissions.index')->with('success', 'Submission approved!');
    }

    public function destroy(string $id){
        $submission = MonsterSightings::findOrFail($id);
        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Submission deleted!');
    }
}
