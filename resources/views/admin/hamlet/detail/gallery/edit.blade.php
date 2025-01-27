@extends('layouts.admin')
@section('title', 'Galeri Dusun')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="card-title fw-semibold mb-2">Halaman Edit Galeri Dusun</h5>
                <a href="{{ route('hamlet_gallery.index', $hamlet_detail->id) }}" class="btn btn-primary ms-auto">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                @include('admin.partials.alert')
                <form action="{{ route('hamlet_gallery.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Menampilkan Gambar Lama -->
                    <div class="mb-3 d-flex align-items-center justify-content-center">
                        <div class="me-2">
                            <img src="{{ Storage::url($album->image) }}" alt="album image" class="img-thumbnail rounded" style="width: 100px;">
                        </div>
                        <div>
                            <img id="preview{{ $album->id }}" src="#" alt="Preview Gambar" class="img-thumbnail rounded" style="display: none; width: 102px;">
                        </div>
                    </div>

                    <!-- Input untuk Gambar Baru -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="image" id="image{{ $album->id }}" onchange="previewImage(event, 'preview{{ $album->id }}')">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Fungsi untuk menampilkan preview gambar
    function previewImage(event, previewId) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById(previewId);
            output.style.display = 'block';
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
