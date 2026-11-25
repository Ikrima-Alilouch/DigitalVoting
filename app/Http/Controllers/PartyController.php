<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use Illuminate\Support\Facades\Storage;

class  PartyController extends Controller
{
    public function userIndex(Request $request)
    {
        $query = Party::query();

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', 'active');
        }

        // Sort by name
        $query->orderBy('name', 'asc');

        $parties = $query->with('members')->get();

        return view('parties.index', compact('parties'));
    }

    public function adminPartyIndex(Request $request)
    {
        $query = Party::query();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Sort the results
        switch ($request->sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'status':
                $query->orderBy('status', 'asc')->orderBy('name', 'asc');
                break;
            default: // name_asc
                $query->orderBy('name', 'asc');
                break;
        }

        $parties = $query->with('members')->get();
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

    public function destroy($id)
    {
        $party = Party::findOrFail($id);
        $party->delete();
        return redirect()->route('admin.parties.index')->with('success', 'Party deleted!');
    }

    public function members(Party $party)
    {
        $members = $party->members;
        return view('admin.parties.members', compact('party', 'members'));
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

        foreach ($request->members as $memberData) {
            $party->members()->create([
                'firstname' => $memberData['firstname'],
                'infix' => $memberData['infix'] ?? null,
                'lastname' => $memberData['lastname'],
                'role' => $memberData['role']
            ]);
        }

        return redirect()->route('admin.parties.members', $party)
            ->with('success', 'Member added successfully.');
    }

    public function updateMember(Request $request, Party $party, $memberId)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        $member = $party->members()->findOrFail($memberId);
        $member->update($request->all());

        return response()->json($member);
    }

    public function destroyMember(Party $party, $memberId)
    {
        $member = $party->members()->findOrFail($memberId);
        $member->delete();

        return redirect()->route('admin.parties.members', $party)
            ->with('success', 'Member removed successfully.');
    }

    public function getMember(Party $party, $memberId)
    {
        $member = $party->members()->findOrFail($memberId);
        return response()->json($member);
    }

    public function show(Party $party)
    {
        $party->load('members');
        return view('parties.show', compact('party'));
    }
}
