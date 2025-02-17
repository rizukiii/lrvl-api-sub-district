<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        // Mencari berdasarkan komentar atau user_id
        $search = $request->get('search');
        $reviews = Review::when($search, function ($query) use ($search) {
            $query->where('comment', 'like', "%{$search}%")
                ->orWhere('user_id', 'like', "%{$search}%");
        })->paginate(10); // Pagination 10 data per halaman

        return view('admin.review.index', compact('reviews'));
    }

    public function show($id)
    {
        // Find the review by its ID or return a 404 if not found
        $review = Review::findOrFail($id);

        // Return the view with the review data
        return view('admin.review.show', compact('review'));
    }
}
