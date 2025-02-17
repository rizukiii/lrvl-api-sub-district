@extends('layouts.admin')
@section('title', 'Detail Review')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Detail Review</h5>
                <div class="btn-group ms-auto">
                    <a href="{{ route('review.index') }}" class="btn btn-primary">
                        Back to Reviews <i class="ti ti-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Review Details -->
                <div class="mb-4">
                    <h5>User Information</h5>
                    <p><strong>Name:</strong> {{ $review->user->name }}</p>
                    <hr>

                    <h5>Review Information</h5>
                    <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
                    <p><strong>Comment:</strong> {{ $review->comment }}</p>

                    <h5>Review Image</h5>
                    @if ($review->image)
                        <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image"
                            style="max-width: 100%; max-height: 400px;">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif

                    <h5>Created At</h5>
                    <p>{{ $review->created_at->format('d M Y H:i:s') }}</p>

                    <h5>Updated At</h5>
                    <p>{{ $review->updated_at->format('d M Y H:i:s') }}</p>
                </div>

            </div>
        </div>
    </div>

@endsection
