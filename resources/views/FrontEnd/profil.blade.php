@extends('layouts.frontend')
@section('title', 'Profil KALURAHAN CONDONGCATUR')
@section('content')

<main class="container my-5">
    <section class="text-center">
        <h1 class="display-4">Profil Kalurahan Condongcatur</h1>
        <h5>By <strong>Condongcatur</strong></h5>
        <hr>
        <h6 class="text-muted">Jan 31, 2017</h6>
    </section>

    <img src="condongcatur.jpg" class="img-fluid mb-4" alt="Gambar Desa">

    <h6 class="mb-4">GAMBARAN UMUM KONDISI DESA</h6>

    <strong>1. Sejarah Kalurahan Condongcatur</strong>
    <p>Pemerintah Kalurahan Condongcatur berdiri pada tanggal 26 Desember 1946 berdasarkan Maklumat Pemerintah Daerah Istimewa Yogyakarta Nomor 5 Tahun 1948.</p>

    <p>Sebelum tahun 1946, Wilayah Desa Condongcatur terbagi menjadi 4 (empat) Kalurahan, yang terdiri dari:</p>
    <ul>
        <li><strong>Kalurahan Manukan</strong><br>Lurah Desanya di Jabat oleh: Jayeng Sumanto. Beliau wafat dan di makamkan di Pemakaman Umum Padukuhan Manukan.</li>
        <li><strong>Kalurahan Gorongan</strong><br>Lurah Desanya dijabat oleh: R.Ng. (Raden Ngabehi) Hadi Prasodjo. Beliau wafat dan dimakamkan di Pemakaman Umum Padukuhan Ngropoh.</li>
        <li><strong>Kalurahan Gejayan</strong><br>Lurah Desanya dijabat oleh: Sastro Diharjo. Beliau wafat dan dimakamkan di Pemakaman Umum Padukuhan Gejayan.</li>
        <li><strong>Kalurahan Kentungan</strong><br>Lurah Desanya dijabat oleh: Kromoredjo. Beliau wafat dan dimakamkan di Pemakaman Umum Komplek Kolombo Padukuhan Joho.</li>
    </ul>

    <h2>Kepala Desa / Lurah Condongcatur Difinitif:</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Tahun 1946 - 1979</td>
                <td>KROMOREDJO</td>
                <td>Pirihan</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tahun 1985 - 1995</td>
                <td>H. KUWAT HADI CHUSNANTO</td>
                <td>Ngroket</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Tahun 1996 - 2004 dan Tahun 2004 - 2009</td>
                <td>H. SUKRIS</td>
                <td>Bandung</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Tahun 2009 - 2015</td>
                <td>MARSUDI, SH</td>
                <td>Krantil</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Tahun 2015 - Sekarang</td>
                <td>RENO CANDRA SANGAJI, S.IP M.IP</td>
                <td>Pendowo</td>
            </tr>
        </tbody>
    </table>

    <h3 class="mt-4">4. Kondisi Ekonomi</h3>
    <p>Berdasarkan data yang diperoleh dari investigasi Aspek Ekonomi dan mata pencaharian, sebagian besar warga Kalurahan Condongcatur didominasi oleh pedagang atau penjual jasa.</p>

    <table class="table table-bordered table-striped">
        <caption>Data Mata Pencaharian Penduduk</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pencaharian</th>
                <th>Jumlah Orang</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Pegawai Negeri Sipil</td><td>1.953</td></tr>
            <tr><td>2</td><td>TNI</td><td>985</td></tr>
            <tr><td>3</td><td>Polri</td><td>213</td></tr>
            <tr><td>4</td><td>Pedagang</td><td>2.690</td></tr>
            <tr><td>5</td><td>Petani/Perkebun</td><td>238</td></tr>
            <tr><td>6</td><td>Peternak</td><td>10</td></tr>
            <tr><td>7</td><td>Industri</td><td>69</td></tr>
            <tr><td>8</td><td>Konstruksi</td><td>103</td></tr>
            <tr><td>9</td><td>Transportasi</td><td>43</td></tr>
            <tr><td>10</td><td>Karyawan Swasta</td><td>7.459</td></tr>
            <tr><td>11</td><td>Karyawan BUMN</td><td>318</td></tr>
            <tr><td>12</td><td>Karyawan BUMD</td><td>50</td></tr>
            <tr><td>13</td><td>Karyawan Honorer</td><td>116</td></tr>
            <tr><td>14</td><td>Buruh Harian Lepas</td><td>1.504</td></tr>
            <tr><td>15</td><td>Buruh Tani/Perkebunan</td><td>206</td></tr>
            <tr><td>16</td><td>Buruh Nelayan/Perikanan</td><td>1</td></tr>
            <tr><td>17</td><td>Buruh Peternakan</td><td>7</td></tr>
            <tr><td>18</td><td>Pembantu Rumah Tangga</td><td>47</td></tr>
            <tr><td>19</td><td>Tukang Cukur</td><td>3</td></tr>
            <tr><td>20</td><td>Tukang Listrik</td><td>10</td></tr>
            <tr><td>21</td><td>Tukang Las</td><td>13</td></tr>
            <tr><td>22</td><td>Tukang Jahit</td><td>61</td></tr>
            <tr><td>23</td><td>Penata Rias</td><td>10</td></tr>
            <tr><td>24</td><td>Penata Busana</td><td>7</td></tr>
            <tr><td>25</td><td>Penata Rambut</td><td>10</td></tr>
            <tr><td>26</td><td>Mekanik</td><td>48</td></tr>
            <tr><td>27</td><td>Seniman</td><td>41</td></tr>
            <tr><td>28</td><td>Tabib</td><td>1</td></tr>
            <tr><td>29</td><td>Perancang Busana</td><td>5</td></tr>
            <tr><td>30</td><td>Peterjemah</td><td>2</td></tr>
            <tr><td>31</td><td>Pendeta</td><td>9</td></tr>
            <tr><td>32</td><td>Pastor</td><td>22</td></tr>
            <tr><td>33</td><td>Ustad/Mubaliq</td><td>5</td></tr>
            <tr><td>34</td><td>Wartawan</td><td>31</td></tr>
            <tr><td>35</td><td>Juru Masak</td><td>9</td></tr>
            <tr><td>36</td><td>Dosen</td><td>495</td></tr>
            <tr><td>37</td><td>Guru</td><td>465</td></tr>
            <tr><td>38</td><td>Pengacara</td><td>29</td></tr>
            <tr><td>39</td><td>Notaris</td><td>14</td></tr>
            <tr><td>40</td><td>Arsitek</td><td>37</td></tr>
            <tr><td>41</td><td>Akuntan</td><td>5</td></tr>
            <tr><td>42</td><td>Konsultan</td><td>26</td></tr>
            <tr><td>43</td><td>Dokter</td><td>234</td></tr>
            <tr><td>44</td><td>Bidan</td><td>11</td></tr>
            <tr><td>45</td><td>Perawat</td><td>71</td></tr>
            <tr><td>46</td><td>Wiraswasta</td><td>751</td></tr>
            <tr><td>47</td><td>Lain-lain</td><td>365</td></tr>
        </tbody>
    </table>

    <h3 class="mt-4">Fasilitas yang Ada di Kelurahan Condongcatur</h3>

    <h4>1. Fasilitas Pendidikan dan Sosial</h4>
    <table class="table table-bordered table-striped">
        <caption>Data Fasilitas Pendidikan</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Kelompok Bermain</td><td>20 buah</td></tr>
            <tr><td>2</td><td>Taman Kanak-kanak</td><td>18 buah</td></tr>
            <tr><td>3</td><td>Sekolah Dasar</td><td>15 buah</td></tr>
            <tr><td>4</td><td>SMP</td><td>5 buah</td></tr>
            <tr><td>5</td><td>SMA</td><td>3 buah</td></tr>
            <tr><td>6</td><td>Perguruan Tinggi</td><td>5 buah</td></tr>
            <tr><td>7</td><td>SLB C</td><td>1 buah</td></tr>
            <tr><td>8</td><td>Pondok Pesantren</td><td>5 buah</td></tr>
        </tbody>
    </table>

    <h4>2. Fasilitas Peribadatan</h4>
    <table class="table table-bordered table-striped">
        <caption>Data Fasilitas Peribadatan</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Masjid</td><td>83 buah</td></tr>
            <tr><td>2</td><td>Mushola</td><td>20 buah</td></tr>
            <tr><td>3</td><td>Gereja Kristen</td><td>2 buah</td></tr>
            <tr><td>4</td><td>Gereja Katolik</td><td>4 buah</td></tr>
            <tr><td>5</td><td>Kapel Katolik</td><td>1 buah</td></tr>
            <tr><td>6</td><td>Vihara</td><td>1 buah</td></tr>
            <tr><td>7</td><td>Pura</td><td>1 buah</td></tr>
        </tbody>
    </table>

    <h4>3. Fasilitas Kesehatan</h4>
    <table class="table table-bordered table-striped">
        <caption>Data Fasilitas Kesehatan</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Rumah Sakit</td><td>2 buah</td></tr>
            <tr><td>2</td><td>Rumah Bersalin/BKIA</td><td>12 buah</td></tr>
            <tr><td>3</td><td>PUSKESMAS</td><td>1 buah</td></tr>
            <tr><td>4</td><td>PUSKESMAS Pembantu</td><td>1 buah</td></tr>
            <tr><td>5</td><td>Apotek/Depo Obat</td><td>16 buah</td></tr>
            <tr><td>6</td><td>Dokter Praktik</td><td>32 buah</td></tr>
            <tr><td>7</td><td>Bidan</td><td>19 buah</td></tr>
        </tbody>
    </table>

    <h4>4. Fasilitas Umum</h4>
    <table class="table table-bordered table-striped">
        <caption>Data Fasilitas Umum</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Pemandian/Kolam Renang</td><td>6 buah</td></tr>
            <tr><td>2</td><td>Hutan Kota</td><td>0 buah</td></tr>
            <tr><td>3</td><td>Tempat Pertunjukan Kesenian</td><td>1 buah</td></tr>
            <tr><td>4</td><td>Tempat Rekreasi Sejarah/Alam</td><td>2 buah</td></tr>
            <tr><td>5</td><td>Penginapan</td><td>20 buah</td></tr>
            <tr><td>6</td><td>Hotel</td><td>6 buah</td></tr>
            <tr><td>7</td><td>Restoran</td><td>12 buah</td></tr>
        </tbody>
    </table>

    <h4>5. Fasilitas Perekonomian</h4>
    <table class="table table-bordered table-striped">
        <caption>Data Fasilitas Perekonomian</caption>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Fasilitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Pasar Umum</td><td>2 buah</td></tr>
            <tr><td>2</td><td>Koperasi Simpan Pinjam</td><td>11 buah</td></tr>
            <tr><td>3</td><td>KUD</td><td>1 buah</td></tr>
            <tr><td>4</td><td>Toko</td><td>260 buah</td></tr>
            <tr><td>5</td><td>Warung</td><td>557 buah</td></tr>
            <tr><td>6</td><td>Bank</td><td>5 buah</td></tr>
            <tr><td>7</td><td>Badan-badan Kredit</td><td>9 buah</td></tr>
        </tbody>
    </table>
</main>
@endsection
