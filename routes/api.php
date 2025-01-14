<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HamletController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PermohonanController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum', // Middleware Sanctum
])->group(function () {
    // Route untuk mendapatkan informasi user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route untuk Profile
    Route::get('profile', [ProfileController::class, 'index']);

    // Route untuk News
    Route::get('news', [NewsController::class, 'getAllNews']);
    Route::get('news/{id}', [NewsController::class, 'getDetailNews']);

    // Route untuk Gallery
    Route::get('gallery', [GalleryController::class, 'getAllGallery']);
    Route::get('gallery/{id}', [GalleryController::class, 'getDetailGallery']);

    // Route untuk Announcement
    Route::get('announcement', [AnnouncementController::class, 'getAllAnnouncement']);
    Route::get('announcement/{id}', [AnnouncementController::class, 'getDetailAnnouncement']);

    // Route untuk Hamlet
    Route::get('hamlet', [HamletController::class, 'getAllHamlet']);
    Route::get('hamlet/{id}', [HamletController::class, 'getDetailHamlet']);

Route::post('receive-data/{nik_id}', [PermohonanController::class, 'receiveData']);




