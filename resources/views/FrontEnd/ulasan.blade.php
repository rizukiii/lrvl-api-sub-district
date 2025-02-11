@extends('layouts.frontend')
@section('title', 'Ulasan')
@section('content')

    <div class="container">
        <h2>Rating Produk: {{ $averageRating }}/5 ⭐</h2>

        <!-- Form Review -->
        @auth
            <form action="{{ url('/reviews') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="rating">Rating:</label>
                    <select name="rating" class="form-control" required>
                        <option value="1">1 - Sangat Buruk</option>
                        <option value="2">2 - Buruk</option>
                        <option value="3">3 - Cukup</option>
                        <option value="4">4 - Baik</option>
                        <option value="5" selected>5 - Sangat Baik</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comment">Ulasan:</label>
                    <textarea name="comment" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image">Upload Gambar:</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            </form>
        @endauth

        <hr>

        <!-- Daftar Ulasan -->
        @foreach ($reviews as $review)
            <div class="border p-3 mb-3">
                <strong>{{ $review->user->name }}</strong> ⭐ {{ $review->rating }}/5
                <p>{{ $review->comment }}</p>
                @if ($review->image)
                    <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" width="100">
                @endif

                @auth
                    @if (auth()->user()->id == $review->user_id)
                        <form action="{{ url('/reviews/' . $review->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
@endsection
