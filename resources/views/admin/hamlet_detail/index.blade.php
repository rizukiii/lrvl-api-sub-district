@extends('layouts.admin')
@section('title', 'Hamlet Detail')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlet Detail Page</h5>
                <a class="btn btn-dark ms-auto" href="{{ route('hamlet_detail.create') }}">
                    <span><i class="ti ti-plus"></i> Tambah Hamlet Detail</span>
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('hamlet_detail.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Search hamlet_detail..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-search"></i> Cari
                        </button>
                    </form>
                </div>

                <!-- hamlet_detail Street Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hamlet_detail as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="w-25 text-center">
                                        <img src="{{ Storage::url($item->maps) }}" alt="gambar desa" style="width: 100px">
                                    </td>
                                    <td class="w-25 text-center">{{ $item->hamlet->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <!-- Gallery Button -->
                                            <a href="{{ route('hamlet_gallery.index', $item->id) }}" class="btn btn-primary">
                                                <i class="ti ti-camera text-light"></i>
                                            </a>

                                            <!-- Info Button -->
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#infoModal{{ $item->id }}">
                                                <i class="ti ti-info-circle"></i>
                                            </button>

                                            <!-- Edit Button -->
                                            <a class="btn btn-warning" href="{{ route('hamlet_detail.edit', $item->id) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                                <!-- Delete Form -->
                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('hamlet_detail.destroy', $item->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- Info Modal -->
                                <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Hamlet Detail Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <img src="{{ Storage::url($item->maps) }}" alt="gambar biasa" class="img-fluid">
                                                </p>
                                                <h5>{{ $item->hamlet->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    {{ $hamlet_detail->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection
