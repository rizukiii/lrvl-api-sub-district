<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\GalleryDetailController;
use App\Http\Controllers\Admin\HamletDetailController;
use App\Http\Controllers\Admin\HamletNumberController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\HamletController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
// Profile routes
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// News routes
Route::resource('news', NewsController::class)->except(['show']);

// Gallery routes
Route::resource('gallery', GalleryController::class)->except(['show']);

// Gallery Details (Album)
Route::prefix('album/{id}')->group(function () {
    Route::get('/', [GalleryDetailController::class, 'index'])->name('album.index');
    Route::post('/', [GalleryDetailController::class, 'store'])->name('album.store');
    Route::put('/', [GalleryDetailController::class, 'update'])->name('album.update');
    Route::delete('/', [GalleryDetailController::class, 'destroy'])->name('album.destroy');
});

// Announcements
Route::resource('announcement', AnnouncementController::class)->except('show');

// Hamlet
Route::resource('hamlet', HamletController::class)->except('show');

// Hamlet Numbers
Route::resource('hamlet_number', HamletNumberController::class)->except('show');

// Hamlet Detail
Route::resource('hamlet_detail', HamletDetailController::class)->except('show');


// route index.html
Route::get('index', function () {
    return view('FrontEnd.index');
})->name('FrontEnd.index');

// });

// Authentication routes
require __DIR__ . '/auth.php';
