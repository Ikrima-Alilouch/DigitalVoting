<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    public function adminPartyIndex()
    {
        return view('admin.parties.index');
    }

    public function adminPartyCreate()
    {
        return view('admin.parties.create');
    }

    public function adminPartyStore(Request $request)
    {
        $request->validate([
            'logo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'seats' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoPath = $file->storeAs('logo', $file->getClientOriginalName(), 'public');
        }

        $party = Party::create([
            'logo' => $logoPath,
            'name' => $request->firstname,
            'description' => $request->infix,
            'seats' => $request->lastname,
            'status' => $request->birthdate,

        ]);

        $party->save();

        return redirect()->route('admin.parties.index')->with('success', 'Party created successfully.');
    }
}
