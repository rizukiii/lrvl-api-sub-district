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

// Submission
// Correct if you intend to use POST for creating
Route::get('submission',[SubmissionController::class, 'fetchAll']);
Route::post('/submission/create', [SubmissionController::class, 'create']);
// Route::get("test", function(){
//     echo "Hello saya sedang belajar annon function";
// });
// Forum

Route::prefix('forum')->group(function(){
    Route::get('all', [ForumController::class, 'all']);
    Route::post('store',[ForumController::class, 'store']);
    Route::get('show/{id}', [ForumController::class, 'show']);
    Route::post('update/{id}',[ForumController::class, 'update']);
    Route::delete('destroy/{id}',[ForumController::class, 'destroy']);
});

Route::get('review',[ReviewController::class, 'index']);
Route::post('review/store',[ReviewController::class, 'store']);
Route::delete('review/destroy',[ReviewController::class, 'destroy']);

// Register
Route::post('register', [AuthController::class, 'register']);

// Login
Route::post('login', [AuthController::class, 'login']);

// Routes with authentication middleware
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // Get user info
    Route::get('user', [AuthController::class, 'user']);
});

