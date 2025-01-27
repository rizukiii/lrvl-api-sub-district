<?php

namespace App\Providers;

use App\Models\Forum;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mengambil data yang dibutuhkan untuk badge
        View::composer('*', function ($view) {
            // Menghitung jumlah user, submission, dan forum
            $userCount = User::where('created_at', '>=', Carbon::now()->subDay(7))->count();  // Ganti dengan query sesuai kebutuhan

            $submissionCount = Submission::where('status', 'diproses')->count();  // Misalnya submission dengan status pending

            $forumCount = Forum::where('created_at', '>=', Carbon::now()->subDay(7))->count();  // Misalnya forum post yang belum dibaca

            // Mengirimkan data ke view
            $view->with(compact('userCount', 'submissionCount', 'forumCount'));
        });
    }
}
