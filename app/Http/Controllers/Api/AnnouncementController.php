<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AnnouncementController extends Controller
{
    /**
     * Fetch all Announcements (API).
     */
    public function all()
    {
        $announcement = Announcement::latest()->get()->map(function ($item) {
            $item->image = $item->image ? url('/') . Storage::url($item->image) : null;
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $announcement);
    }

    /**
     * Fetch single Announcement details by ID (API).
     */
    public function detail($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->image) {
            $announcement->image = url('/') . Storage::url($announcement->image);
        } else {
            unset($announcement->image);
        }

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $announcement);
    }
}
