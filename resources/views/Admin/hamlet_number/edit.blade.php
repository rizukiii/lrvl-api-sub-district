@extends('layouts.admin')
@section('title', 'Hamlets Street')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlets Street Page</h5>
                <a href="{{ route('hamlet_number.index') }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet_number.update', $hamlet_number->id) }}" method="post">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method -->

                    <div class="mb-3">
                        <label for="street" class="form-label">Street</label>
                        <textarea class="form-control" name="street" rows="4">{{ old('street', $hamlet_number->street) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" class="form-control" name="number" value="{{ old('number', $hamlet_number->number) }}">
                    </div>
                    <div class="mb-3">
                        <label for="rt" class="form-label">RT</label>
                        <input type="number" class="form-control" name="rt" value="{{ old('rt', $hamlet_number->rt) }}">
                    </div>
                    <div class="mb-3">
                        <label for="rw" class="form-label">RW</label>
                        <input type="number" class="form-control" name="rw" value="{{ old('rw', $hamlet_number->rw) }}">
                    </div>
                    <div class="mb-3">
                        <label for="village" class="form-label">Village</label>
                        <input type="text" class="form-control" name="village" value="{{ old('village', $hamlet_number->village) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>

@endsection
