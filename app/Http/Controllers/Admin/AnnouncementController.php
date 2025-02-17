<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Announcement::query();

        // Handle searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }

        // Pagination
        $announcement = $query->orderBy('created_at', 'desc')
        ->paginate(5); // 5 items per page

        return view('admin.announcement.index', compact('announcement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('title', 'description', 'date');

        // Proses file gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/announcement', 'public');
        }

        if (Announcement::create($data)) {
            return redirect()->route('announcement.index')->withSuccess('Announcement Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('Announcement Gagal Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image', // Validasi gambar
        ]);

        $data = $request->only('title', 'description', 'date');

        // Proses file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            $data['image'] = $request->file('image')->store('images/announcement', 'public');
        }

        if ($id->update($data)) {
            return redirect()->route('announcement.index')->withSuccess('Announcement Berhasil Diubah');
        }

        return back()->withInput()->withErrors('Announcement Gagal Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $id)
    {
        if ($id->image && Storage::exists($id->image)) {
            Storage::delete($id->image);
        }

        if ($id->delete()) {
            return back()->withSuccess('Announcement Berhasil Di Hapus!');
        } else {
            return back()->withErrors('Announcement Gagal Di Hapus!');
        }
    }



}
