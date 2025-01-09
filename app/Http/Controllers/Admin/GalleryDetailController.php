<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $album = GalleryDetail::where('gallery_id', $id)->paginate(5);
        $galleries = Gallery::all(); // Add this line to fetch all galleries

        return view('admin.gallery_details.index', compact('album', 'gallery', 'galleries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image', // Validasi gambar
        ]);

        // Proses penyimpanan gambar
        $data = ['gallery_id' => $id]; // Menggunakan id galeri yang dikirim dari modal
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/album', 'public');
        }

        $album = GalleryDetail::create($data);

        return redirect()->route('album.index', $id)->with('success', 'Album berhasil ditambahkan.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryDetail $id)
    {
        $request->validate([
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('gallery_id'); // Pastikan data gallery_id dikirim

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('images/album', 'public');
        }

        // Update data album
        if ($id->update($data)) {
            return redirect()->route('album.index', $id->gallery_id)->withSuccess('Album berhasil diubah!');
        }

        return back()->withInput()->withErrors('Album gagal diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryDetail $id)
    {
        if ($id->image && Storage::exists($id->image)) {
            Storage::delete($id->image);
        }

     $id->delete();
            if ($id) {
                return back()->withSuccess('Album Berhasil Di Hapus');
            }
            return back()->withErrors('Album Gagal Di Hapus!');
    }
}
