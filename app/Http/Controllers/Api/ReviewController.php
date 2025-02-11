<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Ambil semua ulasan + rata-rata rating
    public function index()
    {
        $reviews = Review::with('user')->get();
        $averageRating = round(Review::avg('rating'), 1);

        return new JsonResponses(Response::HTTP_OK,"Data berhasil didapatkan!",[
            'reviews' => $reviews,
            'average_rating' => $averageRating ?? 0,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    // Simpan atau Update Review
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'image' => 'nullable|image'
        ]);
        // deklarasi
        // $user = Auth::user();

        // Cek apakah user sudah memiliki review
        $review = Review::where('user_id', $user->id)->first();

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/reviews', 'public');
        } else {
            $imagePath = $review->image ?? null;
        }

        if ($review) {
            // Update review
            $review->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'image' => $imagePath
            ]);

            return new JsonResponses(Response::HTTP_OK,'Ulasan diperbarui!',$review);
        } else {
            // Simpan review baru
            $newReview = Review::create([
                'user_id' => $user->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'image' => $imagePath
            ]);
            return new JsonResponses(Response::HTTP_CREATED,'Ulasan berhasil disimpan!',$newReview);
        }
    }

    // Hapus review
    public function destroy($id)
    {
        $review = Review::where('id', $id)->where('user_id', Auth::id())->first();

        $review->delete();
        return new JsonResponses(Response::HTTP_OK,'Ulasan berhasil dihapus!',$review);
    }
}
