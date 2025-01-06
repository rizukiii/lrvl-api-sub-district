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
     * Fetch all Announcement (API).
     */
    public function getAllAnnouncement()
    {
        $news = Announcement::all();

        $news->transform(function($item){
            $item->image = url('/') . Storage::url($item->image);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $news);
    }

    /**
     * Fetch single Announcement details by ID (API).
     */
    public function getDetailAnnouncement(Announcement $id)
    {
        $id->image = url('/') . Storage::url($id->image);

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $id);
    }
}
