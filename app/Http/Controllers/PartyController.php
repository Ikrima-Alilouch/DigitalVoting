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
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,deactivated',
            'leader_firstname' => 'required|string|max:255',
            'leader_infix' => 'nullable|string|max:255',
            'leader_lastname' => 'required|string|max:255'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoPath = $file->storeAs('logo', $file->getClientOriginalName(), 'public');
        }

        $party = Party::create([
            'logo' => $logoPath,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'leader_firstname' => $request->leader_firstname,
            'leader_infix' => $request->leader_infix,
            'leader_lastname' => $request->leader_lastname
        ]);

        return redirect()->route('admin.parties.index')->with('success', 'Party created successfully.');
    }

    public function adminPartyEdit(Party $party)
    {
        return view('admin.parties.edit', compact('party'));
    }

    public function update(Request $request, Party $party)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'seats' => 'required|integer|min:1',
            'status' => 'required|in:active,deactivated',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'leader_firstname' => 'required|string|max:255',
            'leader_infix' => 'nullable|string|max:255',
            'leader_lastname' => 'required|string|max:255'
        ]);

        if ($request->hasFile('party_image')) {
            if ($party->image) {
                Storage::disk('public')->delete($party->image);
            }
            $imagePath = $request->file('party_image')->store('party-images', 'public');
            $party->image = $imagePath;
        }

        $party->update([
            'name' => $request->name,
            'description' => $request->description,
            'seats' => $request->seats,
            'status' => $request->status,
            'leader_firstname' => $request->leader_firstname,
            'leader_infix' => $request->leader_infix,
            'leader_lastname' => $request->leader_lastname
        ]);

        return redirect()->route('admin.parties.index')
            ->with('success', 'Party updated successfully.');
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

}
