<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'nik_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'date' => \Carbon\Carbon::now()->format('d/m/Y H:i:s'),
            'hamlet_id' => 'required|exists:hamlets,id',
            'status' => 'diproses',
            'requisite' => 'required|string'
        ]);

        $submission = Submission::create($validated);

        return new JsonResponses(Response::HTTP_OK, "Berhasil menambahkan data", $submission);
    }
}
