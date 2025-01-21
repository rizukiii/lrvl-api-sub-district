<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi</title>
    <link rel="stylesheet" href="{{ asset('template_admin') }}/src/assets/css/styles.min.css" />
    <style>
        /* General styles */
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 1.5cm;
        }

        .kop-surat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid black;
            padding-bottom: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }

        .kop-surat div {
            text-align: center;
            flex: 1;
            margin: 0 15px;
        }

        .kop-surat h1,
        .kop-surat h2,
        .kop-surat p {
            margin: 0;
            line-height: 1.5;
        }

        .content {
            text-align: justify;
            line-height: 1.8;
            margin-top: 20px;
        }

        .content p {
            margin: 10px 0;
        }

        .signature {
            margin-top: 2cm;
            text-align: right;
            margin-right: 20px;
        }

        .signature p {
            margin: 0;
        }

        .signature strong {
            display: block;
            margin-top: 20px;
        }

        /* Mobile-first Design */
        @media (max-width: 1024px) {
            .kop-surat {
                flex-direction: column;
                text-align: center;
            }

            .kop-surat img {
                width: 70px;
                margin-bottom: 10px;
            }

            .kop-surat div {
                text-align: center;
                flex: 1;
                margin: 0;
            }

            .content {
                font-size: 14px;
            }

            .signature {
                text-align: center;
                margin-top: 2cm;
                margin-right: 0;
            }
        }

        @media (max-width: 768px) {
            body {
                margin: 1.5cm;
            }

            .kop-surat img {
                width: 60px;
            }

            .content {
                font-size: 13px;
            }

            .signature {
                text-align: center;
                margin-top: 1.5cm;
            }
        }

        @media (max-width: 480px) {
            body {
                margin: 1cm;
            }

            .kop-surat {
                text-align: center;
                flex-direction: column;
                padding-bottom: 10px;
            }

            .kop-surat img {
                width: 50px;
            }

            .content {
                font-size: 12px;
                line-height: 1.4;
            }

            .signature {
                margin-top: 1.5cm;
                text-align: center;
            }

            .signature strong {
                margin-top: 10px;
            }
        }

        /* Print-specific styles */
        @media print {
            @page {
                size: A4;
                margin: 2cm;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                max-width: 100%;
            }

            .kop-surat {
                flex-direction: column;
                text-align: center;
            }

            .kop-surat img {
                width: 60px;
                margin: 5px 0;
            }

            .content {
                font-size: 12pt;
                line-height: 1.6;
            }

            .signature {
                text-align: center;
                margin-top: 2cm;
            }

            .page-break {
                page-break-before: always;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header atau Kop Surat -->
        <header>
            <div class="kop-surat">
                <!-- Gambar di kiri -->
                <img src="{{ asset('lambang.png') }}" alt="Logo Kelurahan">

                <!-- Teks di tengah -->
                <div>
                    <h1>PEMERINTAH KABUPATEN SLEMAN</h1>
                    <h2>KELURAHAN CONDONGCATUR</h2>
                    <p>Jl. Affandi No.1, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta</p>
                </div>

                <!-- Gambar di kanan -->
                <img src="{{ asset('logo_diy.png') }}" alt="Logo DIY">
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
        <div class="signature">
            <p>Kelurahan Condongcatur, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <br>
            <br>
            <br>
            <br>
            <p><strong>Riska Dian Nur Lestari, S.TP. M.Sc</strong></p>
            <p>Sekretaris</p>
        </div>
    </div>
</body>

</html>
