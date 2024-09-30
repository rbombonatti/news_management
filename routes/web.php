<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::get('/home/{news}', [HomeController::class, 'details'])->name('home.details');
Route::get('/search/{search}', [HomeController::class, 'search'])->name('home.search');

Route::middleware('auth')->group(function () {
    Route::resource('news', NewsController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
