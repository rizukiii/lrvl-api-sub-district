@extends('layouts.admin')
@section('title', 'Hamlet Detail')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlet Detail Page</h5>
                <a href="{{ route('hamlet_detail.index', ['id' => $hamlet->id]) }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>

            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet_detail.update', ['id' => $hamlet->id, 'detail_id' => $detail->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method -->
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input
                            type="text"
                            class="form-control"
                            name="latitude"
                            id="latitude"
                            placeholder="Masukan Latitude"
                            value="{{ $detail->latitude }}"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input
                            type="text"
                            class="form-control"
                            name="longitude"
                            id="longitude"
                            placeholder="Masukan Longitude"
                            value="{{ $detail->longitude }}"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>

@endsection
