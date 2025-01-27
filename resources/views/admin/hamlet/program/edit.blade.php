@extends('layouts.admin')
@section('title', 'Edit Program')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Edit Program</h5>
                <a href="{{ route('program.index') }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="hamlet_id" class="form-label">Pilih Dusun</label>
                        <select name="hamlet_id" id="hamlet_id" class="form-select">
                            <option value="">Pilih Dusun</option>
                            @foreach ($hamlet as $item)
                                <option value="{{ $item->id }}" {{ $program->hamlet_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="tel" class="form-control" name="rt" id="rt" value="{{ old('rt', $program->rt) }}" placeholder="Masukan RT" />
                    </div>

                    <div class="mb-3">
                        <label for="work" class="form-label">Kegiatan</label>
                        <input type="text" class="form-control" name="work" id="work" value="{{ old('work', $program->work) }}" placeholder="Masukan Kegiatan" />
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="">Pilih Status</option>
                            <option value="Terlaksana" {{ old('status', $program->status) == 'Terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                            <option value="Belum Terlaksana" {{ old('status', $program->status) == 'Belum Terlaksana' ? 'selected' : '' }}>Belum Terlaksana</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

@endsection
