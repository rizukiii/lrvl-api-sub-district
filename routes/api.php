<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HamletController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForumController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SubmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route untuk mendapatkan informasi user
Route::get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('user', [AuthController::class, 'user']);
});

// Route untuk News
Route::get('news/all', [NewsController::class, 'all']);
Route::get('news/detail/{id}', [NewsController::class, 'detail']);

// Route untuk Gallery
Route::get('gallery/all', [GalleryController::class, 'all']);
Route::get('gallery/detail/{id}', [GalleryController::class, 'detail']);

// Route untuk Announcement
Route::get('announcement/all', [AnnouncementController::class, 'all']);
Route::get('announcement/detail/{id}', [AnnouncementController::class, 'detail']);

// Route untuk Hamlet
Route::get('hamlet/all', [HamletController::class, 'all']);
Route::get('hamlet/detail/{id}', [HamletController::class, 'detail']);

// Submission
Route::get('submission/all', [SubmissionController::class, 'all']);
Route::post('submission/store', [SubmissionController::class, 'store']);

// Forum
Route::get('forum/all', [ForumController::class, 'all']);
Route::post('forum/store', [ForumController::class, 'store']);
Route::get('forum/detail/{id}', [ForumController::class, 'detail']);
Route::put('forum/update/{id}', [ForumController::class, 'update']);
Route::delete('forum/destroy/{id}', [ForumController::class, 'destroy']);

// review
Route::get('reviews/all', [ReviewController::class, 'all']);
Route::post('reviews/store', [ReviewController::class, 'store']);
Route::put('reviews/update/{id}', [ReviewController::class, 'update']);
