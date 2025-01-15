<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Hamlet;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'nik_id' => 'required|exists:users,nik',
            'title' => 'required|string',
            'hamlet_id' => 'required|exists:hamlets,name',
            'requisite' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('nik', $request->nik_id)->first();

        $hamlet = Hamlet::where('name',$request->hamlet_id)->first();

        $submission = Submission::create([
            'nik_id' => $user->id,
            'title' => $request->title,
            'date' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'hamlet_id' => $hamlet->id,
            'status' => 'diproses',
            'requisite' => $request->requisite
        ]);

        return new JsonResponses(Response::HTTP_OK, "Berhasil menambahkan data", $submission);
    }
}
//
