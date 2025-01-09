<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Hamlet\Gallery;
use App\Models\HamletDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HamletDetailController extends Controller
{
     /**
     * Fetch all Gallery (API).
     */
    public function getAllGallery()
    {
        $galeri = HamletDetail::all();

        $galeri->transform(function($item){
            $item->image = url('/') . Storage::url($item->image);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $galeri);
    }

    // public function getDetailGallery(HamletDetail $id)
    // {
    //     // Eager load the `galleries` relationship
    //     $gallery = $id->load('galleries');

    //     // Transform the gallery and related galleries
    //     $gallery->image = url('/') . Storage::url($gallery->image);

    //     // Map over the related galleries to update their URLs
    //     $gallery->galleries = $gallery->galleries->map(function ($image) {
    //         $image->image = url('/') . Storage::url($image->image);
    //         return $image;
    //     });

    //     return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $gallery);
    // }

    public function getDetailGallery(HamletDetail $id)
    {
        // Eager load the `galleries` relationship
        $gallery = $id->load('galleries');
        $detail = $id->load('hamlets');

        // Transform the gallery and related galleries
        $gallery->image = url('/') . Storage::url($gallery->image);


        $detail->nama = url('/') . Storage::url($detail->nama);



        // Map over the related galleries to update their URLs
        $gallery->galleries = $gallery->galleries->map(function ($image) {
            $image->image = url('/') . Storage::url($image->image);
            return $image;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $gallery);
    }


}
