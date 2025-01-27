@extends('layouts.admin')
@section('title', 'Program')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Program Page</h5>
                <a class="btn btn-dark ms-auto" href="{{ route('program.create') }}">
                    <span><i class="ti ti-plus"></i> Add Program</span>
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('program.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search programs..."
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
                                <th>Desa</th>
                                <th>RT</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($program as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">{{ $item->hamlet->name }}</td>
                                    <td class="w-25">{{ $item->rt }}</td>
                                    <td class="w-25">{{ $item->work }}</td>
                                    <td class="w-25">{{ $item->status }}</td>
                                    <td class="text-center">

                                        <div class="btn-group">
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#infoModal{{ $item->id }}">
                                                <i class="ti ti-info-circle"></i>
                                            </button>
                                            <a class="btn btn-warning" href="{{ route('program.edit', $item->id) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('program.destroy', $item->id) }}" method="POST"
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
                                                <h3>Desa : {{ $item->hamlet->name }}</h3>
                                                <h5>RT : {{ $item->rt }}</h5>
                                                <p>Kegiatan : {{ $item->work }}</p>
                                                <p>Status : {{ $item->status }}</p>
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
                    {{ $program->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>



@endsection
