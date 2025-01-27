@extends('layouts.admin')
@section('title', 'Users')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Users Page</h5>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('user.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search users..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-search"></i> Search
                        </button>
                    </form>
                </div>

                <!-- Hamlets Street Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center bg-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Is_Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">{{ $item->name }}</td>
                                    <td class="w-25">{{ $item->nik }}</td>
                                    <td class="w-25">{{ $item->is_admin }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger fw-bold">No data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $user->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>



@endsection
