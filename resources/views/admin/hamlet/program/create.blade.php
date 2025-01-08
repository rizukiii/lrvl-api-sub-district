@extends('layouts.admin')
@section('title', 'Hamlets Program')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlets Program Page</h5>
                <a href="{{ route('hamlet_program.index') }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet_program.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="hamlets_id" class="form-label">Name</label>
                        <select
                            class="form-select"
                            name="hamlets_id"
                            id="hamlets_id"
                        >
                            <option value="">Pilih Desa</option>
                            @foreach ($hamlet as $item)
                            <option value="{{ $item->id }}" @selected($item->id == old('hamlets_id'))>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hamlets_number_id" class="form-label">RT</label>
                        <select
                            class="form-select"
                            name="hamlets_number_id"
                            id="hamlets_number_id"
                        >
                            <option value="">Pilih Desa</option>
                            @foreach ($hamlet as $item)
                            <option value="{{ $item->id }}" @selected($item->id == old('hamlets_number_id'))>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="village">
                    </div>
                    <div class="mb-3">
                        <label for="village" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="village">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
@endsection
