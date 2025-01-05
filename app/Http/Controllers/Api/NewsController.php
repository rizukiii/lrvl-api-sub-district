<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * Fetch all News (API).
     */
    public function getAllNews()
    {
        $news = News::all();

        $news->transform(function($item){
            $item->image = url('/') . Storage::url($item->image);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $news);
    }

    /**
     * Fetch single News details by ID (API).
     */
    public function getDetailNews(News $id)
    {
        $id->image = url('/') . Storage::url($id->image);

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $id);
    }
}
