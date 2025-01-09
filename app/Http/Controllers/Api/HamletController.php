<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Hamlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class HamletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllHamlet()
    {
        $hamlet = Hamlet::all();

        $hamlet->transform(function($item){
            $item->image = url('/') . Storage::url($item->image);
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $hamlet);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getDetailHamlet(Hamlet $id)
    {

        // Eager load the `galleries` relationship
        $hamlet_detail = $id->load('details');
        $hamlet_gallery = $id->load('galleries');

        // Transform the gallery object
        $response = [
            'id' => $id,
            'name' => $id->name, // Pastikan kolom 'name' ada di tabel HamletDetail
            'image' => url('/') . Storage::url($id->image),
            'details' => $hamlet_detail->details->map(function($data){
                return [
                    'id' => $data->hamlet_id,
                    'maps' => url('/') . Storage::url($data->maps),
                ];
            }),
            'galleries' => $hamlet_gallery->galleries->map(function ($image) {
                return [
                    'id' => $image->hamlet_detail_id,
                    'image' => url('/') . Storage::url($image->image),
                ];
            }),
        ];

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapat", $response);
    }
}
