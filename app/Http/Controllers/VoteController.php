<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\User_Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        $parties = Party::where('status', 'active')->get();
        return view('votes.index', compact('parties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'selected_parties' => 'required|array|size:3',
            'selected_parties.*' => 'required|exists:parties,partyID'
        ]);

        // Check if user has already voted
        if (User_Vote::where('id', Auth::id())->exists()) {
            return redirect()->route('votes.index')
                ->with('error', 'You have already cast your vote.');
        }

        // Check for duplicate party selections
        if (count($request->selected_parties) !== count(array_unique($request->selected_parties))) {
            return redirect()->route('votes.index')
                ->with('error', 'You cannot select the same party multiple times.');
        }

        // Record the votes
        foreach ($request->selected_parties as $partyId) {
            User_Vote::create([
                'id' => Auth::id(),
                'partyID' => $partyId
            ]);
        }

        return redirect()->route('votes.thank-you');
    }

    public function thankYou()
    {
        return view('votes.thank-you');
    }

    public function overview()
    {
        // Get the user's votes
        $userVotes = User_Vote::where('id', Auth::id())
            ->with('party')
            ->get();

        // Get all parties with their vote counts
        $parties = Party::where('status', 'active')
            ->withCount(['votes' => function($query) {
                $query->select('partyID');
            }])
            ->get();

        return view('votes.overview', compact('userVotes', 'parties'));
    }

    public function destroy()
    {
        // Delete all votes for the current user
        User_Vote::where('id', Auth::id())->delete();

        return redirect()->route('votes.index')
            ->with('success', 'Your votes have been removed. You can now vote again.');
    }

    public function adminVotingManagement()
    {
        $userVotes = User_Vote::with(['user', 'party'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('id'); // Group by user ID

        return view('admin.votes.management', compact('userVotes'));
    }

//    public function vote(Request $request)
//    {
//        $request->validate([
//            'party_id' => 'required|exists:parties,id',
//        ]);
//
//        return redirect()->route('votes.index')->with('success', 'Vote cast successfully!');
//    }
//
//    public function voteAlgoritm(Request $request)
//    {
//
//    }



}
