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
                <form action="{{ route('hamlet.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <img id="previewCreate" src="#" alt="Preview Gambar" class="img-fluid rounded mt-2 mb-3" style="display: none; width: 100px">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="imageCreate" onchange="previewImage(event, 'previewCreate')">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Hamlet">
                    </div>
                    <div class="mb-3">
                        <label for="leader" class="form-label">Kepala Desa</label>
                        <input type="text" class="form-control" name="leader" id="leader" placeholder="Masukan Kepala Desa">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="title" placeholder="Masukan Deskripsi">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>

@endsection
