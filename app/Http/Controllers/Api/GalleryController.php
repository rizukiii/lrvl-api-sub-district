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
    public function getAllGallery()
    {
        $galeri = Gallery::all();

        $galeri->transform(function($item){
            $item->image = url('/') . Storage::url($item->image);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $galeri);
    }

    /**
     * Fetch single Gallery details by ID (API).
     */

    public function getDetailGallery(Gallery $id)
    {
        // Eager load the `images` relationship
        $gallery = $id->load('images');

        // Transform the gallery and related images
        $gallery->image = url('/') . Storage::url($gallery->image);

        // Map over the related images to update their URLs
        $gallery->images = $gallery->images->map(function ($image) {
            $image->image = url('/') . Storage::url($image->image);
            return $image;
        });

        return $gallery;
    }
}
