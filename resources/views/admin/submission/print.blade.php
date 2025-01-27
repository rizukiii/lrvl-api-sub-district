@extends('layouts.frontend')
@section('title', 'Print Ajuan')
@section('content')
    <style>
        @media print {

            /* Mengatur ukuran halaman menjadi A4 */
            @page {
                size: A4;
                margin: 20mm;
                /* Atur margin sesuai kebutuhan */
            }

            /* Menyesuaikan tata letak untuk kertas A4 */
            body {
                font-size: 12pt;
                line-height: 1.5;
            }

            .container {
                width: 100%;
                padding: 0;
            }

            /* Pastikan gambar responsif dan menyesuaikan ukuran A4 */
            img {
                max-width: 100%;
                height: auto;
            }

            /* Sesuaikan kolom dan elemen lain dalam kop surat agar sesuai dengan ukuran A4 */
            .kop-surat {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1cm;
                /* Sesuaikan jarak antar elemen */
            }

            .kop-surat .col-4 {
                width: 33.33%;
            }

            /* Sesuaikan ukuran font dan margin */
            h1,
            h2 {
                font-size: 18pt;
                margin: 0;
            }

            p {
                font-size: 12pt;
                margin: 0.5cm 0;
            }

            /* Agar tidak ada elemen yang terpotong atau keluar dari halaman */
            .content {
                page-break-before: always;
            }

            .signature {
                page-break-before: always;
            }
        }
    </style>
    <div class="container">
        <!-- Header atau Kop Surat -->
        <header>
            <div class="kop-surat row align-items-center">
                <!-- Gambar di kiri -->
                <div class="col-4">
                    <img src="{{ asset('lambang.png') }}" alt="Logo Kelurahan" class="img-fluid">
                </div>

                <!-- Teks di tengah -->
                <div class="col-4 text-center">
                    <h1>PEMERINTAH KABUPATEN SLEMAN</h1>
                    <h2>KELURAHAN CONDONGCATUR</h2>
                    <p>Jl. Affandi No.1, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta
                    </p>
                </div>

                <!-- Gambar di kanan -->
                <div class="col-4 text-end">
                    <img src="{{ asset('logo_diy.png') }}" alt="Logo DIY" class="img-fluid">
                </div>
            </div>
        </header>

        <!-- Isi Surat -->
        <div class="content">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1cm;">
                <div>
                    <p><strong>Nomor:</strong> {{ $submission->id }}</p>
                    <p><strong>Lampiran:</strong> {{ $submission->lampiran ?? '-' }}</p>
                    <p><strong>Perihal:</strong> {{ $data->perihal ?? '-' }}</p>
                </div>
                <div style="text-align: right;">
                    <p>
                        Kepada Yth. <br>
                        <strong>{{ $submission->user->name }}</strong> <br>
                        Di Tempat
                    </p>
                </div>
            </div>

            <p>Dengan hormat,</p>
            <p>
                Berdasarkan permohonan yang telah diajukan pada tanggal {{ $submission->date }},
                kami menerima informasi berikut:
            </p>

            <p>{{ $submission->requisite }}</p>

            <p>
                Surat ini telah kami terima dan didiskusikan. Untuk informasi lebih lanjut, Bapak/Ibu dapat langsung
                datang
                ke kantor kelurahan untuk proses selanjutnya.
            </p>

            <p>
                Demikian surat ini kami sampaikan. Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.
            </p>
        </div>

        <!-- Tanda Tangan -->
        <div class="signature d-flex justify-content-end align-items-end" style="flex-direction: column;">
            <p>Kelurahan Condongcatur, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <br>
            <br>
            <br>
            <br>
            <p><strong>Riska Dian Nur Lestari, S.TP. M.Sc</strong></p>
            <p>Sekretaris</p>
        </div>
    </div>
@endsection
