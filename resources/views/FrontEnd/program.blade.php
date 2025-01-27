@extends('layouts.frontend')

@section('title', 'Daftar Rencana Pembangunan')

@section('content')
    <main>
        <div class="container my-5">
            <h1 class="text-center mb-4">Daftar Rencana Pembangunan APBD Kelurahan CondongCatur</h1>
            <p class="text-center"><strong>Kecamatan Depok Kabupaten Sleman Tahun Anggaran 2025</strong></p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pedukuhan</th>
                            <th>Lokasi</th>
                            <th>Kegiatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($program as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->hamlet->name }}</td>
                            <td>RT {{ $item->rt }}</td>
                            <td>{{ $item->work }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        @empty
                        <td colspan="10">Data tidak tersedia</td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
