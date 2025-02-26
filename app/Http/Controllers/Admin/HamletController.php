<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hamlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HamletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Hamlet::query();

        // Handle searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%")->orWhere('leader', 'like', "%$search%");
        }

        $hamlet = $query->orderBy('name', 'desc')->paginate(5);

        return view('admin.hamlet.index', compact('hamlet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hamlet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'image' => 'required|image',
            'leader' => 'required|string',
        ]);

        $data = $request->only('name', 'title', 'leader');

        // Proses file gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/hamlet', 'public');
        }

        if (Hamlet::create($data)) {
            return redirect()->route('hamlet.index')->withSuccess('Hamlet Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Hamlet Gagal Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hamlet = Hamlet::findOrFail($id);

        return view('admin.hamlet.edit', compact('hamlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $hamlet = Hamlet::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'image' => 'nullable|image',
            'leader' => 'required|string',
        ]);

        $data = $request->only('name', 'title', 'leader');

        // Proses file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($hamlet->image && Storage::exists($hamlet->image)) {
                Storage::delete($hamlet->image);
            }
            $data['image'] = $request->file('image')->store('images/hamlet', 'public');
        }


        if ($hamlet->update($data)) {
            return redirect()->route('hamlet.index')->withSuccess('Hamlet Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Hamlet Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mendapatkan objek hamlet berdasarkan id
        $hamlet = Hamlet::findOrFail($id);

        // Hapus gambar jika ada
        if ($hamlet->image && Storage::exists($hamlet->image)) {
            Storage::delete($hamlet->image);
        }

        // Hapus data hamlet
        if ($hamlet->delete()) {
            return back()->withSuccess('Hamlet Berhasil Di Hapus!');
        } else {
            return back()->withErrors('Hamlet Gagal Di Hapus!');
        }
    }
}
