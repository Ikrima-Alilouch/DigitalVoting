<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView(User $user)
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function profileUpdate(Request $request, User $user)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'profilepic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:25',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('image', $filename, 'public');
            $validatedData['profilepic'] = $path;
        }
        $user->update($validatedData);
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}
