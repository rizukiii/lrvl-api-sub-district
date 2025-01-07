@extends('layouts.admin')
@section('title', 'Album')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title fw-semibold mb-0">Album Page</h5>
            <div class="ms-auto">
                <a href="{{ route('gallery.index') }}" class="btn btn-primary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-dark ms-2" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="ti ti-plus"></i> Tambah Gambar
                </button>
            </div>
        </div>

        <div class="card-body">
            @include('admin.partials.alert')

            <!-- Tabel Daftar Gambar -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="text-center bg-light">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($album as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center w-50">
                                    <img src="{{ Storage::url($item->image) }}" alt="album image" class="img-thumbnail rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#infoModal{{ $item->id }}">
                                            <i class="ti ti-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('album.destroy', $item->id) }}" method="POST" style="display: none;">
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
                                            <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Detail Gambar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ Storage::url($item->image) }}" alt="album image" class="img-fluid rounded mb-3">
                                            <h5>ID Gallery: {{ $item->gallery_id }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Gambar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('album.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3 d-flex align-items-center justify-content-center">
                                                    <div class="me-2">
                                                        <img src="{{ Storage::url($item->image) }}" alt="album image" class="img-thumbnail rounded" style="width: 100px;">
                                                    </div>
                                                    <div>
                                                        <img id="preview{{ $item->id }}" src="#" alt="Preview Gambar" class="img-thumbnail rounded" style="display: none; width: 102px;">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Gambar</label>
                                                    <input type="file" class="form-control" name="image" id="image{{ $item->id }}" onchange="previewImage(event, 'preview{{ $item->id }}')">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-danger">Tidak ada gambar dalam album ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $album->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Image Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Gambar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('album.store', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <img id="previewCreate" src="#" alt="Preview Gambar" class="img-fluid rounded mt-2 mb-3" style="display: none; width: 100px">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="imageCreate" onchange="previewImage(event, 'previewCreate')">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Gambar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
