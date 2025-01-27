@extends('layouts.admin')
@section('title', 'Submission')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Submission History</h5>
                <a class="btn btn-dark ms-auto" href="{{ route('submission.index') }}">
                    <span><i class="ti ti-arrow-left"></i> Back</span>
                </a>
            </div>
            <div class="card-body">

                <!-- Search Form -->
                <div class="d-flex mb-3">
                    <form action="{{ route('submission.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Search submissions..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-search"></i> Search
                        </button>
                    </form>
                </div>

                <!-- Submission Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="text-center bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($submission as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->nik }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <span class="badge
                                            @if ($item->status === 'diterima') bg-success
                                            @else bg-danger @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('submission.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $item->id }}">
                                                <i class="ti ti-info-circle"></i> Detail
                                            </button>
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="ti ti-trash"></i> Delete
                                            </button>
                                            <a href="{{ route('print',$item->id) }}" class="btn btn-success" target="_blank">
                                                <i class="ti ti-eyes"></i> View PDf
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Info Modal -->
                                <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="infoModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="infoModalLabel{{ $item->id }}">Submission Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>NIK:</strong> {{ $item->user->nik }}</p>
                                                <p><strong>Layanan:</strong> {{ $item->title }}</p>
                                                <p><strong>Tanggal:</strong> {{ $item->date }}</p>
                                                <p><strong>Desa:</strong> {{ $item->hamlet->name }}</p>
                                                <p><strong>Keperluan:</strong> {{ $item->requisite }}</p>
                                                <p><strong>Status Saat Ini:</strong> {{ ucfirst($item->status) }}</p>
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
                    {{ $submission->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection
