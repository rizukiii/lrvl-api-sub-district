<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\Hamlet\GalleryController as GalleryHamlet;
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
Route::get('news', [NewsController::class, 'index'])->name('news.index');
Route::post('news', [NewsController::class, 'store'])->name('news.store');
Route::put('news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

// Announcements routes
Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcement.index');
Route::post('announcements', [AnnouncementController::class, 'store'])->name('announcement.store');
Route::put('announcements/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
Route::delete('announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

// Gallery routes
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::put('gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
Route::delete('gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

// Gallery Details (Album)
Route::prefix('album/{id}')->group(function () {
    Route::get('/', [GalleryDetailController::class, 'index'])->name('album.index');
    Route::post('/', [GalleryDetailController::class, 'store'])->name('album.store');
    Route::put('/', [GalleryDetailController::class, 'update'])->name('album.update');
    Route::delete('/', [GalleryDetailController::class, 'destroy'])->name('album.destroy');
});



// Hamlet
Route::resource('hamlet', HamletController::class)->except('show');

// Hamlet Numbers
Route::resource('hamlet_number', HamletNumberController::class)->except('show');

// Hamlet Detail
Route::resource('hamlet_detail', HamletDetailController::class)->except('show');

// Hamlet Gallery
Route::resource('hamlet_gallery', GalleryHamlet::class)->except('show');


// route index.html
Route::get('index', function () {
    return view('FrontEnd.index');
})->name('FrontEnd.index');

// });

// Authentication routes
require __DIR__ . '/auth.php';
