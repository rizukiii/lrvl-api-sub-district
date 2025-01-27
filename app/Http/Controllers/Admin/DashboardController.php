<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Forum;
use App\Models\Gallery;
use App\Models\Hamlet;
use App\Models\News;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function analisis()
    {
        $forums = Forum::all();
        $submissions = Submission::all();
        $news = News::all();
        $hamlets = Hamlet::all();
        $galleries = Gallery::all();
        $announcements = Announcement::all();

        return view('admin.dashboard.dashboard', [
            'forums' => $forums,
            'submissions' => $submissions,
            'news' => $news,
            'hamlets' => $hamlets,
            'galleries' => $galleries,
            'announcements' => $announcements,
        ]);
    }
}
