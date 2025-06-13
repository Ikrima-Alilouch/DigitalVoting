<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    public function userIndex()
    {
        $parties = Party::where('status', 'active')->with('members')->get();
        return view('parties.index', compact('parties'));
    }

    public function adminPartyIndex()
    {
        $parties = Party::with('members')->get();
        return view('admin.parties.index', compact('parties'));
    }

    public function adminPartyCreate()
    {
        return view('admin.parties.create');
    }

    public function adminPartyStore(Request $request)
    {
        $validatedData = $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255|unique:parties',
            'description' => 'nullable|string',
            'status' => 'required|in:active,deactivated',
            'leader_firstname' => 'required|string|max:255',
            'leader_infix' => 'nullable|string|max:255',
            'leader_lastname' => 'required|string|max:255'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('logo', $filename, 'public');
            $validatedData['logo'] = $path;
        }

        Party::create($validatedData);

        return redirect()->route('admin.parties.index')->with('success', 'Party created successfully.');
    }

    public function adminPartyEdit(Party $party)
    {
        return view('admin.parties.edit', compact('party'));
    }

    public function update(Request $request, Party $party)
    {
        $request->validate([
            'name' => 'required|unique:parties,name,' . $party->partyID . ',partyID',
            'description' => 'nullable|string',
            'status' => 'required|in:active,deactivated',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'leader_firstname' => 'required|string|max:255|unique:parties,leader_firstname,' . $party->partyID . ',partyID',
            'leader_infix' => 'nullable|string|max:255',
            'leader_lastname' => 'required|string|max:255'
        ]);

        if ($request->hasFile('logo')) {
            if ($party->logo) {
                Storage::disk('public')->delete($party->logo);
            }
            $logoPath = $request->file('logo')->store('party-logo', 'public');
            $party->logo = $logoPath;
        }

        $party->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'leader_firstname' => $request->leader_firstname,
            'leader_infix' => $request->leader_infix,
            'leader_lastname' => $request->leader_lastname
        ]);

        return redirect()->route('admin.parties.index')->with('success', 'Party updated successfully.');
    }

    public function destroy(Party $party)
    {
        if ($party->image) {
            Storage::disk('public')->delete($party->image);
        }

        $party->delete();

        return redirect()->route('admin.parties.index')
            ->with('success', 'Party deleted successfully.');
    }

    public function members(Party $party)
    {
        $members = $party->members;
        return view('parties.admin.members', compact('party', 'members'));
    }

    public function updateMembers(Request $request, Party $party)
    {
        $request->validate([
            'members' => 'required|array',
            'members.*.firstname' => 'required|string|max:255',
            'members.*.infix' => 'nullable|string|max:255',
            'members.*.lastname' => 'required|string|max:255',
            'members.*.role' => 'required|string|max:255'
        ]);

        $party->members()->delete();

        foreach ($request->members as $member) {
            PartyMember::create([
                'partyID' => $party->partyID,
                'firstname' => $member['firstname'],
                'infix' => $member['infix'],
                'lastname' => $member['lastname'],
                'role' => $member['role']
            ]);
        }

        return redirect()->route('admin.parties.index')
            ->with('success', 'Party members updated successfully.');
    }

    public function show(Party $party)
    {
        $party->load('members');
        return response()->json($party);
    }
}
