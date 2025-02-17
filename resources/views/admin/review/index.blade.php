@extends('layouts.admin')
@section('title', 'Daftar Review')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Daftar Review</h5>
                <div class="btn-group ms-auto">
                </div>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('review.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search reviews..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-search"></i> Search
                        </button>
                    </form>
                </div>

                <!-- Reviews Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center bg-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Gambar</th>
                                <th>Actions</th> <!-- New column for Show button -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $review->user->name }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ Str::limit($review->comment, 30, '...') }}</td>
                                    <td class="w-25">
                                        @if ($review->image)
                                            <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" style="width: 100px">
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Show button linking to the show page for the specific review -->
                                        <a href="{{ route('review.show', $review->id) }}" class="btn btn-info btn-sm">
                                            Show
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $reviews->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection
