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
    
}
