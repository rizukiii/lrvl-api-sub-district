<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function history(Request $request){
        $search = $request->input('search');
        $submission = Submission::where('status','diterima')->orWhere('status','ditolak')
        ->when($search,function($query, $search){
            return $query->where('nik_id','like',"%{$search}%")
            ->orWhere('title','like',"%{$search}%");
        })
        ->paginate(5);
        return view('admin.submission.history',compact('submission'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $submission = Submission::
        where('status', 'diproses') // Filter hanya status diproses
            ->when($search, function ($query, $search) {
                return $query->where('nik_id', 'like', "%{$search}%")
                            ->orWhere('title', 'like', "%{$search}%");
            })
            ->paginate(5); // Menampilkan 10 item per halaman

        return view('admin.submission.index', compact('submission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $submission = Submission::findOrFail($id);
        $submission->status = $request->status;
        $submission->save();

        return redirect()->route('submission.index')->with('success', 'Status berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();

        if($submission){
            return back()->withSuccess('Data Berhasil Di Perbarui');
        } else {
            return back()->withErrors('Data Gagal Di Hapus!');
        }
    }

    public function printData($id){

        $submission = Submission::findOrFail($id);

        return view('admin.submission.print',compact('submission'));
    }

}
