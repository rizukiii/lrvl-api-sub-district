<?php

use App\Http\Controllers\Admin\Gallery\DetailController as GalleryDetailController;
use App\Http\Controllers\Admin\Hamlet\GalleryController as HamletGalleryController;
use App\Http\Controllers\Admin\Hamlet\DetailController as HamletDetailController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HamletController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SubmissionController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\Hamlet\ProgramController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Frontend\DisplayController;
use Illuminate\Support\Facades\Route;

Route::get('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('regis', [AuthenticationController::class, 'regis'])->name('regis');

// route dari folder FrontEnd
Route::get('profil', [DisplayController::class, 'profil'])->name('FrontEnd.profil');
Route::get('pejabat', [DisplayController::class, 'pejabat'])->name('FrontEnd.pejabat');
Route::get('pkk', [DisplayController::class, 'pkk'])->name('FrontEnd.pkk');
Route::get('rukun', [DisplayController::class, 'rukun'])->name('FrontEnd.rukun');
Route::get('linmas', [DisplayController::class, 'linmas'])->name('FrontEnd.linmas');
Route::get('lpmkal', [DisplayController::class, 'lpmkal'])->name('FrontEnd.lpmkal');
Route::get('program', [DisplayController::class, 'program'])->name('FrontEnd.program');
Route::get('privacypolicy',[DisplayController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('lupapassword',[DisplayController::class, 'lupapassword'])->name('lupapassword');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'analisis'])->name('dashboard');

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

    // Hamlet Detail
    Route::prefix('hamlet/{id}')->group(function () {
        Route::get('/details', [HamletDetailController::class, 'index'])->name('hamlet_detail.index');
        Route::get('/details/create', [HamletDetailController::class, 'create'])->name('hamlet_detail.create');
        Route::post('/details/store', [HamletDetailController::class, 'store'])->name('hamlet_detail.store');
        Route::get('/details/{detail_id}/edit', [HamletDetailController::class, 'edit'])->name('hamlet_detail.edit');
        Route::put('/details/{detail_id}', [HamletDetailController::class, 'update'])->name('hamlet_detail.update');
        Route::delete('/details/{detail_id}', [HamletDetailController::class, 'destroy'])->name('hamlet_detail.destroy');
    });

    // Hamlet Gallery
    Route::get('hamlet_gallery/{id}', [HamletGalleryController::class, 'index'])->name('hamlet_gallery.index');
    Route::get('hamlet_gallery/create/{id}', [HamletGalleryController::class, 'create'])->name('hamlet_gallery.create');
    Route::post('hamlet_gallery/store/{id}', [HamletGalleryController::class, 'store'])->name('hamlet_gallery.store');
    Route::get('hamlet_gallery/edit/{id}', [GalleryController::class, 'edit'])->name('hamlet_gallery.edit');
    Route::put('hamlet_gallery/update/{id}', [HamletGalleryController::class, 'update'])->name('hamlet_gallery.update');
    Route::delete('hamlet_gallery/destroy/{id}', [HamletGalleryController::class, 'destroy'])->name('hamlet_gallery.destroy');

    // submision route
    Route::get('submission', [SubmissionController::class, 'index'])->name('submission.index');
    Route::get('history', [SubmissionController::class, 'history'])->name('submission.history');
    Route::put('submission/{id}', [SubmissionController::class, 'update'])->name('submission.update');
    Route::delete('submission/{id}', [SubmissionController::class, 'destroy'])->name('submission.destroy');
    Route::get('print/{id}', [SubmissionController::class, 'generatePdf'])->name('print');

    // Forum
    Route::get('forum', [Forumcontroller::class, 'index'])->name('forum.index');
    Route::delete('forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');

    // User
    Route::get('user', [UserController::class, 'index'])->name('user.index');

    // Hamlet Program
    Route::get('program/index', [ProgramController::class, 'index'])->name('program.index');
    Route::get('program/create', [ProgramController::class, 'create'])->name('program.create');
    Route::post('program/store', [ProgramController::class, 'store'])->name('program.store');
    Route::get('program/edit/{id}',[ProgramController::class, 'edit'])->name('program.edit');
    Route::put('program/update/{id}',[ProgramController::class, 'update'])->name('program.update');
    Route::delete('program/delete{id}',[ProgramController::class, 'destroy'])->name('program.destroy');
});
