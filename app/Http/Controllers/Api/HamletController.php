<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Hamlet;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HamletController extends Controller
{
    /**
     * Get all Hamlets with their details and galleries.
     */
    public function getAllHamlet()
    {
        $hamlet = Hamlet::all();

        $hamlet->transform(function ($item) {
            $item->maps = url('/') . Storage::url($item->maps);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $hamlet);
    }

    /**
     * Get details of a specific Hamlet by ID.
     */
    public function getDetailHamlet(Hamlet $id)
    {
        $detail = $id->load(['details.galleries']);

        $detail->image = url('/') . Storage::url($detail->image);

        // Iterate over each hamlet_detail and map galleries
        $detail->details->transform(function ($hamletDetail) {

        // Transform the detail's `maps` field to full URL
        $hamletDetail->maps = url('/') . Storage::url($hamletDetail->maps);

            // Map over the related galleries for each hamlet detail
            $hamletDetail->galleries = $hamletDetail->galleries->map(function ($image) {
                $image->image = url('/') . Storage::url($image->image);
                return $image;
            });
            return $hamletDetail;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $detail);
    }
}
