<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Hamlet;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    /**
     * Fetch all submissions with user & hamlet relations.
     */
    public function all()
    {
        $submissions = Submission::with(['user', 'hamlet'])->get();

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapatkan!", $submissions);
    }

    /**
     * Create a new submission.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik_id' => 'required|exists:users,nik',
            'title' => 'required|string',
            'hamlet_id' => 'required|exists:hamlets,name',
            'requisite' => 'required|string'
        ]);

        $user = User::where('nik', $data['nik_id'])->firstOrFail();
        $hamlet = Hamlet::where('name', $data['hamlet_id'])->firstOrFail();

        $submission = Submission::create([
            'nik_id' => $user->id,
            'title' => $data['title'],
            'date' => now()->format('Y-m-d H:i:s'),
            'hamlet_id' => $hamlet->id,
            'status' => 'diproses',
            'requisite' => $data['requisite']
        ]);

        return new JsonResponses(Response::HTTP_CREATED, "Berhasil menambahkan data", $submission);
    }
}
