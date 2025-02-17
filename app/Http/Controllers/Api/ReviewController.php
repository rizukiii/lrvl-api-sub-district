<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Get all reviews.
     */
    public function all()
    {
        $reviews = Review::with('user')->latest()->get()->map(function ($review) {
            $review->image = $review->image ? url('/') . Storage::url($review->image) : null;
            return $review;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapatkan!", $reviews);
    }

    /**
     * Store a new review.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/reviews', 'public');
        }

        $review = Review::create($data);

        return new JsonResponses(Response::HTTP_CREATED, "Data berhasil ditambahkan!", $review);
    }

    /**
     * Get a specific review.
     */
    public function detail($id)
    {
        $review = Review::with('user')->findOrFail($id);

        $review->image = $review->image ? url('/') . Storage::url($review->image) : null;

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapatkan!", $review);
    }

    /**
     * Update an existing review.
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $data = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if (!empty($review->image) && Storage::disk('public')->exists($review->image)) {
                Storage::disk('public')->delete($review->image);
            }
            $data['image'] = $request->file('image')->store('images/reviews', 'public');
        }

        $review->update($data);

        return new JsonResponses(Response::HTTP_OK, "Data berhasil diperbarui!", $review);
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if (!empty($review->image) && Storage::disk('public')->exists($review->image)) {
            Storage::disk('public')->delete($review->image);
        }

        $review->delete();

        return new JsonResponses(Response::HTTP_OK, "Review berhasil dihapus!", null);
    }
}
