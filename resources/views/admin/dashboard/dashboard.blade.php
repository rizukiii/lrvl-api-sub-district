@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mb-3">Selamat Datang!!</h3>

        </div>
    </div>
    <div class="row">
        <!-- Forums Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Forums</h5>
                    <p class="card-text">Total Forums: {{ $forums->count() }}</p>
                    <a href="{{ route('forum.index') }}" class="btn btn-primary">View Forums</a>
                </div>
            </div>
        </div>

        <!-- Submissions Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Submissions</h5>
                    <p class="card-text">Total Submissions: {{ $submissions->count() }}</p>
                    <a href="{{ route('submission.index') }}" class="btn btn-primary">View Submissions</a>
                </div>
            </div>
        </div>

        <!-- News Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">News</h5>
                    <p class="card-text">Total News: {{ $news->count() }}</p>
                    <a href="{{ route('news.index') }}" class="btn btn-primary">View News</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Hamlets Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Hamlets</h5>
                    <p class="card-text">Total Hamlets: {{ $hamlets->count() }}</p>
                    <a href="{{ route('hamlet.index') }}" class="btn btn-primary">View Hamlets</a>
                </div>
            </div>
        </div>

        <!-- Announcements Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Announcements</h5>
                    <p class="card-text">Total Announcements: {{ $announcements->count() }}</p>
                    <a href="{{ route('announcement.index') }}" class="btn btn-primary">View Announcements</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Galleries Card -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Galleries</h5>
                    <p class="card-text">Total Galleries: {{ $galleries->count() }}</p>
                    <a href="{{ route('gallery.index') }}" class="btn btn-primary">View Galleries</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
