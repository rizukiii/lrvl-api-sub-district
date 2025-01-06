@extends('layouts.admin')
@section('title', 'Hamlets Street')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Hamlets Street Page</h5>
                <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span><i class="ti ti-plus"></i> Tambah Hamlets Street</span>
                </button>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlets_number.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter hamlets_number title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Enter hamlets_number description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>

            </div>
        </div>
    </div>
@endsection
