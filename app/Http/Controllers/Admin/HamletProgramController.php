<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HamletProgram;
use Illuminate\Http\Request;

class HamletProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = HamletProgram::query();
        $hamlet_program = $query->orderBy('work', 'desc')->paginate(5);

        return view('admin.hamlet.program.index',compact('hamlet_program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hamlet.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'work' => 'required|string',
            'annotation' => 'required|string',
            'hamlet_id' => 'required|numeric',
            'hamlet_number_id' => 'required|numeric',
        ]);

        $data = $request->only('work', 'annotation', 'hamlet_id', 'hamlet_number_id');

        if (HamletProgram::create($data)) {
            return redirect()->route('hamlet.program.index')->withSuccess('Hamlet Program Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Hamlet Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hamlet_program = HamletProgram::findOrFail($id);

        return view('admin.hamlet.program.edit',compact('hamlet_program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hamlet_program = HamletProgram::findOrFail($id);

        $request->validate([
            'street' => 'required|string',
            'number' => 'required|numeric',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'village' => 'required|string',
        ]);

        $data = $request->only('street', 'number', 'rt', 'rw', 'village');

        if ($hamlet_program->update($data)) {
            return redirect()->route('hamlet.program.index')->withSuccess('Hamlet Program Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Hamlet Program Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $hamlets_program = HamletProgram::findOrFail($id);

        if ($hamlets_program->delete()) {
            return back()->withSuccess('Hamlet Program Berhasil Di Hapus!');
        } else {
            return back()->withErrors('Hamlet Program Gagal Di Hapus!');
        }
    }
}
