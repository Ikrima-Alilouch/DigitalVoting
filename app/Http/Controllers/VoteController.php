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

}
