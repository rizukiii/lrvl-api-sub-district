@extends('layouts.admin')
@section('title', 'Hamlet')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlet Page</h5>
                <a href="{{ route('hamlet.index') }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet.update', $hamlet->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method -->

                    <div class="mb-3 d-flex align-items-center justify-content-center">
                        <div class="me-2">
                            <img src="{{ Storage::url($hamlet->image) }}" alt="album image" class="img-thumbnail rounded" style="width: 100px;">
                        </div>
                        <div>
                            <img id="preview{{ $hamlet->id }}" src="#" alt="Preview Gambar" class="img-thumbnail rounded" style="display: none; width: 102px;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="image{{ $hamlet->id }}" onchange="previewImage(event, 'preview{{ $hamlet->id }}')">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $hamlet->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="leader" class="form-label">Kepala Desa</label>
                        <input type="text" class="form-control" name="leader" value="{{ old('leader', $hamlet->leader) }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $hamlet->title) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>

@endsection
