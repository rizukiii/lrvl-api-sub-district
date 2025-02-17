<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * Fetch all News (API).
     */
    public function all()
    {
        $news = News::latest()->get()->map(function ($item) {
            $item->image = $item->image ? url('/') . Storage::url($item->image) : null;
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $news);
    }

    /**
     * Fetch single News details by ID (API).
     */
    public function detail($id)
    {
        $news = News::findOrFail($id);

        $news->image = $news->image ? url('/') . Storage::url($news->image) : null;

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $news);
    }
}
