<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('backend.index');
    })->name('admin');                            

    // Replace the existing general_settings route with a resource route
    Route::resource('general-settings', GeneralSettingController::class);
    
    // Add service resource routes
    Route::resource('services', ServiceController::class);

    // Add quotation resource routes
    Route::resource('quotations', QuotationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
