@extends('layouts.admin')
@section('title', 'Hamlet Detail')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlet Page</h5>
                <a href="{{ route('hamlet_detail.index') }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet_detail.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <img id="previewCreate" src="#" alt="Preview Gambar" class="img-fluid rounded mt-2 mb-3" style="display: none; width: 100px">
                    </div>
                    <div class="mb-3">
                        <label for="maps" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="maps" id="imageCreate" onchange="previewImage(event, 'previewCreate')">
                    </div>
                    <div class="mb-3">
                        <label for="hamlets_id" class="form-label">Name</label>
                        <select
                            class="form-select form-select"
                            name="hamlets_id"
                            id="hamlets_id"
                        >
                            <option value="">Pilih Desa</option>
                            @foreach ($hamlet as $item)
                            <option value="{{ $item->id }}" @selected($item->id == old('hamlets_id'))>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>

@endsection
