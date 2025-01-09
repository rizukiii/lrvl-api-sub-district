<?php

use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HamletController;
use App\Http\Controllers\Api\HamletDetailController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('profile', action: [ProfileController::class, 'index']);
Route::get('news', action: [NewsController::class, 'getAllNews']);
Route::get('news/{id}', action: [NewsController::class, 'getDetailNews']);

Route::get('gallery', action: [GalleryController::class, 'getAllGallery']);
Route::get('gallery/{id}', action: [GalleryController::class, 'getDetailGallery']);

Route::get('announcement', action: [AnnouncementController::class, 'getAllAnnouncement']);
Route::get('announcement/{id}', action: [AnnouncementController::class, 'getDetailAnnouncement']);

Route::get('hamlet', action: [HamletController::class, 'getAllHamlet']);
Route::get('hamlet/{hamlet}', action: [HamletController::class, 'getDetailHamlet']);


Route::get('hamlet_gallery', action: [HamletDetailController::class, 'getAllGallery']);
Route::get('hamlet_gallery/{id}', action: [HamletDetailController::class, 'getDetailGallery']);



