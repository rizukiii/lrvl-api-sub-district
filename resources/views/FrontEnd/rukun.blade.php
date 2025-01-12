@extends('layouts.frontend')
@section('title', 'RT & RW')
@section('content')
<main class="container my-5">
    <section class="text-center">
        <h1 class="display-4">RT & RW</h1>
        <h5>By <strong>Condongcatur</strong></h5>
        <hr>
        <h6 class="text-muted">Jan 31, 2017</h6>
    </section>

    <section class="mt-4">
        <p>
            Kalurahan Condongcatur terdiri dari <strong>211 RT</strong> dan <strong>64 RW</strong> yang tersebar di <strong>18 Padukuhan</strong>.
        </p>
        <p>
            Berikut adalah data nama-nama Ketua RT dan Ketua RW di Kalurahan Condongcatur:
        </p>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Padukuhan</th>
                        <th scope="col">Ketua RW</th>
                        <th scope="col">Ketua RT</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh Data -->
                    <tr>
                        <td>1</td>
                        <td>Padukuhan A</td>
                        <td>Bapak Sugiono</td>
                        <td>Bapak Supriyanto</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Padukuhan B</td>
                        <td>Ibu Sumarni</td>
                        <td>Bapak Hartono</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Padukuhan C</td>
                        <td>Bapak Sutrisno</td>
                        <td>Bapak Marwoto</td>
                    </tr>
                    <!-- Tambahkan data lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
