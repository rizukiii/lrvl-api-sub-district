@extends('layouts.admin')
@section('title', 'Gallery')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title fw-semibold mb-0">Gallery Page</h5>
            <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
                <span>
                    <i class="ti ti-plus"></i> Tambah Gallery
                </span>
            </button>
        </div>

        <div class="card-body">
            @include('admin.partials.alert')

            <!-- Search Form -->
            <div class="mb-4">
                <form action="{{ route('gallery.index') }}" method="GET" class="d-flex w-100">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari gallery..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-search"></i> Cari
                    </button>
                </form>
            </div>

            <!-- Gallery Table -->
            <table class="table table-bordered table-striped">
                <thead class="text-center bg-light">
                    <tr  class="text-center">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gallery as $item)
                        <tr  class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ Storage::url($item->image) }}" alt="gambar gallery" style="width: 100px; height: 100px; object-fit: cover" class="rounded img-thumbnail">
                            </td>
                            <td>{{ Str::limit($item->title, 50, '...') }}</td>
                            <td>
                                <a href="{{ route('album.index', $item->id) }}" class="btn btn-primary">
                                    <i class="ti ti-camera text-light"></i>
                                </a>
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}">
                                    <i class="ti ti-info-circle"></i>
                                </button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Info Modal -->
                        <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Detail Galeri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ Storage::url($item->image) }}" alt="gambar gallery" class="img-fluid rounded mb-3">
                                        <h5>{{ $item->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Galeri</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('gallery.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3 d-flex align-items-center justify-content-center">
                                                <div class="me-2">
                                                    <img src="{{ Storage::url($item->image) }}" alt="gambar gallery" class="img-thumbnail rounded" style="width: 100px;">
                                                </div>
                                                <div>
                                                    <img id="preview{{ $item->id }}" src="#" alt="Preview Gambar" class="img-thumbnail rounded" style="display: none; width: 102px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="image" id="image{{ $item->id }}" onchange="previewImage(event, 'preview{{ $item->id }}')">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Judul</label>
                                                <input type="text" class="form-control" name="title" value="{{ $item->title }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">Tidak ada galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $gallery->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Create Gallery Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Galeri Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <img id="previewCreate" src="#" alt="Preview Gambar" class="img-fluid rounded mt-2 mb-3" style="display: none; width: 100px">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="imageCreate" onchange="previewImage(event, 'previewCreate')">
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="title" placeholder="Masukkan judul gallery">
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
