<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return 'welcome';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 🛡️ حمايــة النوتس
Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
});
