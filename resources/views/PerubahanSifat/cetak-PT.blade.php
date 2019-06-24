<html>
<head>
  <style>
    @page :first{
      margin-top: 5.5cm;
    }
    p {
      margin: 0pt;
    }
    body {
      margin: 0;
      font-family: "Times New Roman", Times, serif;
      font-size: 11pt;
    }
    .header{
      text-align: center;
    }
    .jstfy {
      text-indent: 50px;
      text-align: justify;
      text-justify: inter-word;
    }
    .col-1 {
    float: left;
    width: 100px;
    }
    .col-2 {
    float: left;
    width: 260px;
    padding-right: 100px;
    }
    .col-3 {
    float: left;
    width: 220px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
  </style>
  <title>Surat Perubahan Sifat - {{$data->no_surat_permohonan}}</title>
</head>
<body>
  <div class="row">
    <div class="col-1">
      <br>
      <br>Nomor
      <br>Klasifikasi
      <br>Lampiran
      <br>Perihal
    </div>
    <div class="col-2">
      <br>
      <br>: {{$data->no_surat_rekomendasi}}
      <br>: Biasa.
      <br>: 1 (satu) gabung.
      <br>: Rekomendasi Perubahan Sifat Angkutan Orang Tidak Dalam Trayek (Angkutan Sewa Khusus)
    </div>
    <div class="col-3">
      Denpasar, {{Fungsi::bulanID(date('Y-m-d'))}}
      <br>
      <br>Kepada
      <br>
      <br>Yth. <b>{{$perusahaan->nama_perusahaan}}</b>
      <br><b>Di -</b>
      <p style="text-indent: 30px;"><u><b style="text-transform: uppercase;">{{$wilperusahaan->wilayah}}</b></u></p>
    </div>
  </div>
  <br><br>
<div style="padding-left: 100px;">
  <p class="jstfy">Menunjuk surat permohonan dari <b>{{$katperusahaan->kategori_perusahaan}}</b> <b>{{$perusahaan->nama_perusahaan}}</b> Nomor : <b>{{$data->no_surat_permohonan}}</b> Tanggal <b>{{Fungsi::bulanID($data->tgl_surat_permohonan)}}</b> Perihal Permohonan Rekomendasi Rubah Sifat Angkutan Orang Tidak Dalam Trayek (Angkutan Sewa Khusus) Sesuai dengan Surat Kepala Dinas Perhubungan Provinsi Bali Nomor <b>{{$data->nosuratpenyelenggaraan}}</b> Tanggal <b>{{Fungsi::bulanID($data->tglsuratpenyelenggaraan)}}</b>, Perihal Persetujuan Permohonan Izin Penyelenggaraan Angkutan Orang Tidak Dalam Trayek (Angkutan Sewa Khusus).</p>
  <p class="jstfy">Sehubungan dengan hal tersebut di atas, pada prinsipnya kami tidak keberatan dengan permohonan saudara sesuai dengan <b>{{$suratpasal->pasal_permen}}</b> Peraturan Menteri Perhubungan Republik Indonesia Nomor <b>{{$suratpasal->no_permen}}</b>, Tentang Penyelenggaraan Angkutan Orang dengan Kendaraan Bermotor Umum Tidak Dalam Trayek. {{ $data->tahun_kendaraan < $setting->tahunkendaraan ? 'Agar sebelum masa peralihan dibuktikan dengan' : 'Dibuktikan dengan' }} <b>Buku Pemilik Kendaraan Bermotor (BPKB)</b> atau <b>Surat Tanda Nomor Kendaraan (STNK)</b> menjadi atas Nama Badann Hukum dengan data kendaraan sebagai berikut :</p>
</div>
<br>
<div style="padding-left: 120px;">
  <div class="row">
    <div style="float: left; width: 150px;">Nomor Faktur</div>
    <div style="float: left; width: 200px;">: {{$data->no_faktur}}</div>
    <div style="float: right; width: 200px;"> Tanggal : {{$data->tgl_faktur ? Fungsi::bulanID($data->tgl_faktur) : '-'}}</div>
  </div>
  <div class="row">
    <div style="float: left; width: 150px;">
      Nomor Kendaraan
      {{-- @if ($data->tahun_kendaraan < $setting->tahunkendaraan)
        <br>Tahun
        <br>
      @endif --}}
      <br>Model / Merk
      <br>Jenis
      <br>Nomor Rangka
      <br>Nomor Mesin
      <br>Nama Pemilik
      <br>Alamat
      {{-- @if ($data->tahun_kendaraan >= $setting->tahunkendaraan)
        <br>
        <br><b>Menjadi</b>
      @endif --}}
    </div>
    <div style="float: left; width: 432px;">
      : {{$data->no_kendaraan}}
      {{-- @if ($data->tahun_kendaraan < $setting->tahunkendaraan)
        <br>: <span style="text-transform: uppercase;">{{Fungsi::bulanID($data->tahun_kendaraan)}} <b><u>HARUS BADAN HUKUM</u></b> {{ Fungsi::bulanID(date("Y-m-d", strtotime(date("Y-m-d", strtotime($data->tahun_kendaraan)) . " + 5 year"))) }}</span>
      @endif --}}
      <br>: {{$merk->merk}}
      <br>: {{$jeniskendaraan->jenis}}
      <br>: {{$data->no_rangka}}
      <br>: {{$data->no_mesin}}
      <br>: {{$data->pemilik}}
      <br>: <b style="text-transform: uppercase;">{{$data->alamat}}</b>
      {{-- @if ($data->tahun_kendaraan >= $setting->tahunkendaraan)
        <br>
        <br><b>:</b>
        <br>: <span style="text-transform: uppercase;">{{ $perusahaan->nama_perusahaan }}</span>
        <br>: <span style="text-transform: uppercase;"><b>{{ $perusahaan->alamat }}</b></span>
      @endif --}}
    </div>
  </div>
  <br>Demikian disampaikan untuk menjadi maklum.
</div>
<div class="row">
  <div style="float: right; width: 380px;">
    <br><b>KEPALA DINAS PERHUBUNGAN</b>
    <br><b>PROVINSI BALI</b>
    <br><br><br>
    <br><u><b style="text-transform: uppercase;">{{$setting->kadis}}</b></u>
    <br>{{$setting->jabatan}}
    <br>NIP. {{$setting->nip}}
  </div>
</div>
<div style="font-size: 10pt;">
  <br><u><b>Tembusan Yth. :</b></u>
  <br>1. Gubernur Bali (sebagai laporan);
  <br>2. Direktur Lalu Lintas Polda Bali;
  <br>3. Kepala Badan Pendapatan Daerah Provinsi Bali;
  @if ($data->tahun_kendaraan >= $setting->tahunkendaraan)
    <br>4. Kepala Dinas Perhubungan {{$wilperusahaan->id == 1 ? 'Kota' : 'Kab.'}} {{$wilperusahaan->wilayah}} di {{$wilperusahaan->kota}};
    <br>5. Kasubdit Min Regident Ditlantas Polada Bali;
    <br>6. Kepala UPT. Badan Pendapatan Daerah Provinsi Bali {{$wilperusahaan->id == 1 ? 'Kota' : 'Kab.'}} {{$wilperusahaan->wilayah}} di {{$wilperusahaan->kota}};
  @else
    <br>4. Kepala Dinas Perhubungan {{$data->wilayahPemilik->id == 1 ? 'Kota' : 'Kab.'}} {{$data->wilayahPemilik->wilayah}} di {{$data->wilayahPemilik->kota}};
    <br>5. Kasubdit Min Regident Ditlantas Polada Bali;
    <br>6. Kepala UPT. Badan Pendapatan Daerah Provinsi Bali {{$data->wilayahPemilik->id == 1 ? 'Kota' : 'Kab.'}} {{$data->wilayahPemilik->wilayah}} di {{$data->wilayahPemilik->kota}};
  @endif
  <br>7. Ketua DPD Organda Bali.
</div>
</body>
</html>
