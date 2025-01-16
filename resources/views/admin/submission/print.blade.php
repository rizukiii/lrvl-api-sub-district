<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi</title>
    <link rel="stylesheet" href="{{ asset('template_admin') }}/src/assets/css/styles.min.css" />
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 2cm;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            text-align: center;
            margin-bottom: 2cm;
        }

        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .kop-surat img {
            width: 80px;
            height: auto;
        }

        .kop-surat div {
            text-align: center;
            flex: 1;
            margin: 0 10px;
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
        }

        .content p {
            margin: 10px 0;
        }

        .signature {
            margin-top: 3cm;
            text-align: right;
        }

        .signature p {
            margin: 0;
        }

        .signature strong {
            display: block;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                margin: 1.5cm;
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
                font-size: 14px;
            }

            .signature {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            body {
                margin: 1cm;
            }

            .kop-surat div {
                margin: 0;
            }

            .content {
                font-size: 12px;
            }

            .signature {
                margin-top: 2cm;
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
