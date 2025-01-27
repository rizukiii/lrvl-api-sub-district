@extends('layouts.admin')
@section('title', 'Galeri Dusun')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Halaman Galeri Dusun</h5>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url()->previous() }}" class="btn btn-primary ms-auto">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>

                        <a class="btn btn-dark ms-auto" href="{{ route('hamlet_gallery.create', $hamlet_detail->id) }}">
                            <span><i class="ti ti-plus"></i> Tambah Hamlet</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Hamlets Street Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center bg-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($album as $item)
                                <tr  class="text-center">
                                    <td class="w-25">{{ $loop->iteration }}</td>
                                    <td class="w-25">
                                        <img src="{{ Storage::url($item->image) }}" alt="gambar desa" style="width: 100px">
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $item->id }}">
                                            <i class="ti ti-info-circle"></i>
                                            </button>
                                            <a href="{{ route('hamlet_gallery.edit', $item->id) }}" class="btn btn-warning">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <form id="delete-form-{{ $item->id }}" action="{{ route('hamlet_gallery.destroy', $item->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                                <!-- Info Modal -->
                                <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Hamlet Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{ $item->name }}</h5>
                                                <p>
                                                    <img src="{{ Storage::url($item->image) }}" alt="gambar biasa" class="img-fluid">
                                                </p>
                                                <p>{{ $item->title }}</p>
                                                <p>{{ $item->rt }}</p>
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
                    {{ $album->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>



@endsection
