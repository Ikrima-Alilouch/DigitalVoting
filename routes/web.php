<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartyController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Party;
use Illuminate\Support\Facades\Auth;

// Homepage route (public, not requiring auth)
Route::get('/', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return view('dashboard.admin');
    } elseif (Auth::check()) {
        return view('dashboard.user');
    } else {
        return redirect()->route('login');
    }
})->middleware('auth')->name('home');

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return view('dashboard.admin');
    } elseif (Auth::check()) {
        return view('dashboard.user');
    } else {
        return redirect()->route('login');
    }
})->middleware('auth')->name('dashboard');

Route::get('/about', function () {
    return view('homepage.about');
})->name('about');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profileView'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'profileView']);
    Route::post('/profileUpdate', [ProfileController::class, 'profileUpdate'])->name('profile.update');

    Route::get('/votes', function() {
        $parties = Party::where('status', 'active')->orderBy('name')->get();
        return view('users.votes.index', compact('parties'));
    })->name('votes.index');
    Route::get('/parties', [PartyController::class, 'userIndex'])->name('parties.index');
    Route::get('/parties/{party}', [PartyController::class, 'show'])->name('parties.show');
    Route::post('/votes', [VoteController::class, 'store'])->name('votes.store');
    Route::get('/voting-overview', function() {
        $userVotes = \App\Models\User_Vote::where('id', Auth::id())->with('party')->get();
        $parties = \App\Models\Party::where('status', 'active')->withCount('votes')->get();
        return view('users.votes.overview', compact('userVotes', 'parties'));
    })->name('votes.overview');
    Route::delete('/votes', [VoteController::class, 'destroy'])->name('votes.destroy');
    Route::get('/votes/thank-you', [VoteController::class, 'thankYou'])->name('votes.thank-you');
});

// Remove duplicate and inconsistent admin route groups, use only one with proper prefix and middleware
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    // Party management
    Route::get('/parties', [PartyController::class, 'adminPartyIndex'])->name('parties.index');
    Route::get('/parties/create', [PartyController::class, 'adminPartyCreate'])->name('parties.create');
    Route::post('/parties', [PartyController::class, 'adminPartyStore'])->name('parties.store');
    Route::get('/parties/{party}/edit', [PartyController::class, 'adminPartyEdit'])->name('parties.edit');
    Route::put('/parties/{party}', [PartyController::class, 'update'])->name('parties.update');
    Route::delete('/parties/{party}', [PartyController::class, 'destroy'])->name('parties.destroy');
    Route::get('/parties/{party}', [PartyController::class, 'show'])->name('parties.show');

    // Member management
    Route::get('/parties/{party}/members', [PartyController::class, 'members'])->name('parties.members');
    Route::put('/parties/{party}/members', [PartyController::class, 'updateMembers'])->name('parties.members.update');
    Route::put('/parties/{party}/members/{member}', [PartyController::class, 'updateMember'])->name('parties.members.update.member');
    Route::delete('/parties/{party}/members/{member}', [PartyController::class, 'destroyMember'])->name('parties.members.destroy');
    Route::get('/parties/{party}/members/{member}', [PartyController::class, 'getMember'])->name('parties.members.get');

    // Voting management
    Route::get('/votes', [VoteController::class, 'adminVotingManagement'])->name('votes.management');

    Route::get('/parties/{party}/json', function(App\Models\Party $party) {
        $party->load('members');
        return response()->json($party);
    })->name('parties.json');
});

Route::get('/homepage', function () {
    return view('homepage.home');
})->name('homepage');

Route::delete('/admin/parties/{party}', [PartyController::class, 'destroy'])->name('admin.parties.destroy');

Route::resource('parties', PartyController::class);
// Or, if you want custom routes:
Route::get('parties/{party}/edit', [PartyController::class, 'edit'])->name('parties.edit');
Route::delete('parties/{party}', [PartyController::class, 'destroy'])->name('parties.destroy');
Route::get('parties/{party}/members', [PartyController::class, 'members'])->name('parties.members');
