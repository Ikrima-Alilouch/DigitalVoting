<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartyController;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', function () {
    return view('homepage.home');
})->name('home');

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
    Route::get('/profileEdit', [ProfileController::class, 'profileEditView'])->name('profile.edit');
    Route::post('/profileEdit', [ProfileController::class, 'profileEditView']);
    Route::post('/profileUpdate', [ProfileController::class, 'profileUpdate'])->name('profile.update');

    Route::get('/votes', [VoteController::class, 'index'])->name('votes.index');
    Route::get('/parties', [PartyController::class, 'userIndex'])->name('parties.index');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/adminPartyManagement', [PartyController::class, 'adminPartyIndex'])->name('admin.parties.index');
    Route::get('/adminPartyCreate', [PartyController::class, 'adminPartyCreate'])->name('admin.parties.create');
    Route::post('/adminPartyCreate', [PartyController::class, 'adminPartyStore'])->name('admin.parties.store');
    Route::get('/admin/parties/{party}/edit', [PartyController::class, 'adminPartyEdit'])->name('admin.parties.edit');
    Route::put('/admin/parties/{party}', [PartyController::class, 'update'])->name('admin.parties.update');
    Route::delete('/admin/parties/{party}', [PartyController::class, 'destroy'])->name('admin.parties.destroy');

    // Member management routes
    Route::get('/admin/parties/{party}/members', [PartyController::class, 'members'])->name('admin.parties.members');
    Route::put('/admin/parties/{party}/members', [PartyController::class, 'updateMembers'])->name('admin.parties.members.update');
    Route::put('/admin/parties/{party}/members/{member}', [PartyController::class, 'updateMember'])->name('admin.parties.members.update.member');
    Route::delete('/admin/parties/{party}/members/{member}', [PartyController::class, 'destroyMember'])->name('admin.parties.members.destroy');
    Route::get('/admin/parties/{party}/members/{member}', [PartyController::class, 'getMember'])->name('admin.parties.members.get');
});
