<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\User\UserController;

Route::get('/', [AuthenticationController::class,'index'])->name('home');

Route::post('/user/login', [AuthenticationController::class,'login'])->name("signin");

Route::get('/logout', [AuthenticationController::class,'logout'])->name("logout");

Route::post('/fetch/users', [USERController::class,'showUsers'])->name("user.fetchUsers");

Route::post('/register', [AuthenticationController::class,'register'])->name("register");
Route::get('/login', [AuthenticationController::class,'signin'])->name("login");

Route::get('/profile',[UserController::class,'index'])->name('profile')->middleware('auth');

Route::post('/profile',[UserController::class,'update'])->name('profile.update')->middleware('auth');

Route::get('/chats',[ChatController::class,'index'])->name('chat.index')->middleware('auth');
Route::get('/chat/{id}',[ChatController::class,'fetchMessages'])->name('chat.fetchMessages')->middleware('auth');
Route::get('/fetch/messages/{receiver_id}',[ChatController::class,'loadMessages'])->name('chat.loadMessages')->middleware('auth');
Route::get('/inbox',[ChatController::class,'inbox'])->name('inbox')->middleware('auth');

Route::get('/messages', [ChatController::class, 'fetchMessages'])->middleware('auth');
Route::post('/messages', [ChatController::class, 'sendMessage']);

