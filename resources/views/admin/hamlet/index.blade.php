@extends('layouts.admin')
@section('title', 'Hamlet')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlet Page</h5>
                <div class="btn-group ms-auto">
                    <a class="btn btn-dark" href="{{ route('hamlet.create') }}">
                        <span><i class="ti ti-plus"></i> Add Hamlet</span>
                    </a>
                    <a href="{{ route('program.index') }}" class="btn btn-primary">
                        Program<i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('hamlet.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search hamlets..."
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
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Kepala Desa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hamlet as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">
                                        <img src="{{ Storage::url($item->image) }}" alt="gambar desa" style="width: 100px">
                                    </td>
                                    <td class="w-25">{{ $item->name }}</td>
                                    <td class="w-25">{{ Str::limit($item->title, 30, '...') }}</td>
                                    <td class="w-25">{{ $item->leader }}</td>
                                    <td class="text-center">

                                        <div class="btn-group">
                                            <a href="{{ route('hamlet_detail.index', ['id' => $item->id]) }}" class="btn btn-primary">
                                                <i class="ti ti-map-pin text-light"></i>
                                            </a>
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#infoModal{{ $item->id }}">
                                                <i class="ti ti-info-circle"></i>
                                            </button>
                                            <a class="btn btn-warning" href="{{ route('hamlet.edit', $item->id) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('hamlet.destroy', $item->id) }}" method="POST"
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
                                                <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Hamlet
                                                    Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{ $item->name }}</h5>
                                                <p>
                                                    <img src="{{ Storage::url($item->image) }}" alt="gambar biasa"
                                                        class="img-fluid">
                                                </p>
                                                <p>{{ $item->title }}</p>
                                                <p>{{ $item->leader }}</p>
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
                    {{ $hamlet->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>



@endsection
