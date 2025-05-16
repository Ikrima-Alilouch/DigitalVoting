<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('welcome');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('welcome');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'profilepic' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:25',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:16|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/u',
            'BSNnumber' => 'required|string|unique:users',
        ]);

        $BSNnumber = $request->BSNnumber;

        $hash = hash('sha512', $BSNnumber);

        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $profilepicPath = $file->storeAs('profilepics', $file->getClientOriginalName(), 'public');
        } else {
            $profilepicPath = 'profilepics/user-icon-white.png';
        }

        $user = User::create([
            'profilepic' => $profilepicPath,
            'firstname' => $request->firstname,
            'infix' => $request->infix,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'BSNnumber' => $hash,
        ]);

        $user->profilepic = asset('storage/' . $user->profilepic);

        auth()->login($user);

        return redirect()->route('welcome');
    }

}
