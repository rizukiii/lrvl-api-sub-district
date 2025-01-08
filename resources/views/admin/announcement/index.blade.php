@extends('layouts.admin')
@section('title', 'Announcement')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex">
            <h5 class="card-title fw-semibold mb-2">Announcement Page</h5>
            <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
                <span><i class="ti ti-plus"></i> Tambah Announcement</span>
            </button>
        </div>
        <div class="card-body">
            @include('admin.partials.alert')

            <!-- Search Form -->
            <div class="d-flex mb-3">
                <form action="{{ route('announcement.index') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search announcement..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-search"></i> Cari
                    </button>
                </form>
            </div>

            <!-- Announcement Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="text-center bg-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcement as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->image) }}" alt="announcement image" class="rounded img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td class="w-25">{{ Str::limit($item->title, 30, '...') }}</td>
                                <td class="w-25">{{ Str::limit($item->description, 30, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                <td class=" justify-content-center">
                                    <button class="btn btn-secondary mb-1 me-1" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}">
                                        <i class="ti ti-info-circle"></i>
                                    </button>
                                    <button class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button class="btn btn-danger mb-1" onclick="confirmDelete({{ $item->id }})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('announcement.destroy', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Info Modal -->
                            <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Announcement Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ Storage::url($item->image) }}" alt="announcement image" class="img-fluid rounded mb-3">
                                            <h5>{{ $item->title }}</h5>
                                            <p>{{ $item->description }}</p>
                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Announcement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('announcement.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3 d-flex align-items-center justify-content-center">
                                                    <div class="me-2">
                                                        <img src="{{ Storage::url($item->image) }}" alt="announcement image" class="img-thumbnail rounded" style="width: 100px;">
                                                    </div>
                                                    <div>
                                                        <img id="preview{{ $item->id }}" src="#" alt="Preview Image" class="img-thumbnail rounded" style="display: none; width: 102px;">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image{{ $item->id }}" class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image{{ $item->id }}" onchange="previewImage(event, 'preview{{ $item->id }}')">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{ $item->title }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" rows="4">{{ $item->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" name="date" value="{{ $item->date }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
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
                {{ $announcement->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add New Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('announcement.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <img id="previewCreate" src="#" alt="Preview Image" class="img-fluid rounded mt-2 mb-3" style="display: none; width: 100px">
                    </div>

                    <div class="mb-3">
                        <label for="imageCreate" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="imageCreate" onchange="previewImage(event, 'previewCreate')">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter announcement title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Enter announcement description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
