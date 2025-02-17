<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller
{
    /**
     * Fetch all Gallery (API).
     */
    public function all()
    {
        $galeri = Gallery::latest()->get()->map(function ($item) {
            $item->image = $item->image ? url('/') . Storage::url($item->image) : null;
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $galeri);
    }

    /**
     * Fetch single Gallery details by ID (API).
     */
    public function detail($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);

        $gallery->image = $gallery->image ? url('/') . Storage::url($gallery->image) : null;

        $gallery->images = $gallery->images->map(function ($image) {
            $image->image = $image->image ? url('/') . Storage::url($image->image) : null;
            return $image;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $gallery);
    }
}
