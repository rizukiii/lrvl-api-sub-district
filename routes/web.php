<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\GalleryDetailController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\HamletNumberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::post('news', [NewsController::class, 'store'])->name('news.store');
    Route::post('news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::post('gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('album/{id}', [GalleryDetailController::class, 'index'])->name('album.index');
    Route::post('album/{id}', [GalleryDetailController::class, 'store'])->name('album.store');
    Route::put('album/{id}', [GalleryDetailController::class, 'update'])->name('album.update');
    Route::delete('album/{id}', [GalleryDetailController::class, 'destroy'])->name('album.destroy');

    Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement.index');
    Route::post('announcement', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::post('announcement/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('announcement/{id}', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

    Route::get('hamlets_number',[HamletNumberController::class, 'index'])->name('announcement.index');


    // });

require __DIR__ . '/auth.php';
