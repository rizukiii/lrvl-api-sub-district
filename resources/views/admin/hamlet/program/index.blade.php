@extends('layouts.admin')
@section('title', 'Hamlets Program')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlets Program Page</h5>
                <a class="btn btn-dark ms-auto" href="{{ route('hamlet_program.create') }}">
                    <span><i class="ti ti-plus"></i> Tambah Hamlets Program</span>
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('hamlet_program.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Search hamlets_number..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-search"></i> Cari
                        </button>
                    </form>
                </div>

                <!-- Hamlets Program Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>No</th>
                                <th>Dusun</th>
                                <th>RT</th>
                                <th>Proyek</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hamlet_program as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">{{ $item->hamlet->name }}</td>
                                    <td class="w-25">{{ $item->hamlet_number->rt }}</td>
                                    <td class="w-25">{{ $item->work }}</td>
                                    <td class="w-25">{{ $item->annotation }}</td>
                                    <td class=" justify-content-center">
                                        <button class="btn btn-secondary mb-1 me-1" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $item->id }}">
                                            <i class="ti ti-info-circle"></i>
                                        </button>
                                        <a class="btn btn-warning mb-1" href="{{ route('hamlet_program.edit', $item->id) }}">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button class="btn btn-danger mb-1" onclick="confirmDelete({{ $item->id }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('hamlet_program.destroy', $item->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Info Modal -->
                                <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Hamlets
                                                    Program Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{ $item->street }}</h5>
                                                <p>{{ $item->number }}</p>
                                                <p>{{ $item->rt }}</p>
                                                <p>{{ $item->rw }}</p>
                                                <p>{{ $item->village }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-danger fw-bold">No data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $hamlet_program->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>



@endsection
