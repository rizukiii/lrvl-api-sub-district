<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permohonan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function receiveData($nik_id)
    {
        try {

            $wish = Permohonan::latest()->where('nik_id', $nik_id)->get();
            $wish->all();

            return response()->json([
                'status' => 'Success',
                'message' => 'Data received successfully',
                'data' => $wish
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Error',
                'message' => $e->getMessage(),
                'data' => null
            ], 404);
        }
    }
}
