<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/profile', [ProfileController::class, 'profileView'])->name('profile.index')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'profileView']);

Route::get('/profileEdit', [ProfileController::class, 'profileEditView'])->name('profile.edit')->middleware('auth');
Route::post('/profileEdit', [ProfileController::class, 'profileEditView']);
Route::post('/profileUpdate', [ProfileController::class, 'profileUpdate'])->name('profile.update')->middleware('auth');

Route::get('/votes', [VoteController::class, 'index'])->name('votes.index')->middleware('auth');

