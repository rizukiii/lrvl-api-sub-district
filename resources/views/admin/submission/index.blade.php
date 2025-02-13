@extends('layouts.admin')
@section('title', 'Submission')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Submission Page</h5>
                <a class="btn btn-dark ms-auto" href="{{ route('submission.history') }}">
                    <span><i class="ti ti-history"></i> History</span>
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')

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
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($submission as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->nik ?? 'tidak di temukan'}}</td>
                                    <td>{{ $item->user->name ?? 'tidak di temukan'}}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <span class="badge
                                            @if ($item->status === 'diterima') bg-success
                                            @elseif ($item->status === 'diproses') bg-warning
                                            @else bg-danger @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $item->id }}">
                                            <i class="ti ti-finger"></i> Tanggapi
                                        </button>
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
                                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</p>
                                                <p><strong>Desa:</strong> {{ $item->hamlet->name }}</p>
                                                <p><strong>Keperluan:</strong> {{ $item->requisite }}</p>
                                                <p><strong>Status Saat Ini:</strong> {{ ucfirst($item->status) }}</p>

                                                <!-- Form untuk Mengubah Status -->
                                                <form action="{{ route('submission.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Ubah Status</label>
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
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
                    {{ $submission->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection
