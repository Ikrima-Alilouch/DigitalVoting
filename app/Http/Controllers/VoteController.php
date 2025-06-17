<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $parties = Party::all();
        return view('votes.index', compact('parties'));
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
