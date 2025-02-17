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
    public function all()
    {
        $hamlets = Hamlet::latest()->get()->map(function ($item) {
            $item->image = $item->image ? url('/') . Storage::url($item->image) : null;
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $hamlets);
    }

    /**
     * Get details of a specific Hamlet by ID.
     */
    public function detail($id)
    {
        $hamlet = Hamlet::with(['details.galleries'])->findOrFail($id);

        $hamlet->image = $hamlet->image ? url('/') . Storage::url($hamlet->image) : null;

        // Map setiap `details` untuk memproses `galleries`
        $hamlet->details->map(function ($detail) {
            $detail->galleries = $detail->galleries->map(function ($gallery) {
                $gallery->image = $gallery->image ? url('/') . Storage::url($gallery->image) : null;
                return $gallery;
            });
            return $detail;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $hamlet);
    }
}
