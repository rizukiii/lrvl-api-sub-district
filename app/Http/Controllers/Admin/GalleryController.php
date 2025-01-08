<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Handle searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%$search%");
        }

        // Pagination
        $gallery = $query->orderBy('title', 'desc')
        ->paginate(5); // 5 items per page

        return view('admin.gallery.index', compact('gallery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('title');

        // Proses file gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
            ->store('images/gallery', 'public');
        }

        if (Gallery::create($data)) {
            return redirect()->route('gallery.index')->withSuccess('Gallery Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Gallery Gagal Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('title');

        // Proses file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            $data['image'] = $request->file('image')->store('images/gallery', 'public');
        }

        if ($id->update($data)) {
            return redirect()->route('gallery.index')->withSuccess('Gallery Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Gallery Gagal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $id)
    {
        {
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }

            if ($id->delete()) {
                return back()->withSuccess('Gallery Berhasil Di Hapus!');
            } else {
                return back()->withErrors('Gallery Gagal Di Hapus!');
            }
        }
    }
}
