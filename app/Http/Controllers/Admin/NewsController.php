<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::query();

        // Handle searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }

        // Pagination
        $news = $query->orderBy('date', 'desc')
        ->paginate(5); // 5 items per page

        return view('admin.news.index', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validasi gambar
        ]);

        $data = $request->only('title', 'description', 'date');

        // Proses file gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/news', 'public');
        }

        if (News::create($data)) {
            return redirect()->route('news.index')->withSuccess('News Berhasil Ditambahkan');
        }

        return back()->withInput()->withErrors('News Gagal Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validasi gambar
        ]);

        $data = $request->only('title', 'description', 'date');

        // Proses file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image && Storage::exists($id->image)) {
                Storage::delete($id->image);
            }
            $data['image'] = $request->file('image')->store('images/news', 'public');
        }

        if ($id->update($data)) {
            return redirect()->route('news.index')->withSuccess('News Berhasil Diubah');
        }

        return back()->withInput()->withErrors('News Gagal Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $id)
    {
        if ($id->image && Storage::exists($id->image)) {
            Storage::delete($id->image);
        }

        if ($id->delete()) {
            return back()->withSuccess('News Berhasil Di Hapus!');
        } else {
            return back()->withErrors('News Gagal Di Hapus!');
        }
    }



}
