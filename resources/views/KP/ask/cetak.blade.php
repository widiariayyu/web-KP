<html>

<head>
  <style>
    @page :first {
      margin-top: 5.5cm;
    }

    p {
      margin: 0pt;
    }

    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 11pt;
    }

    .jstfy {
      line-height: 2;
      text-align: justify;
      text-justify: inter-word;
    }

    th,
    td {
      text-align: left;
      vertical-align: top;
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
  <title>Kartu Pengawasan Nomor : {{$data->no_kp}}</title>
</head>

<body>
  <div style="font-size: 13pt; text-align: center;">
    <p><b>KARTU PENGAWASAN ANGKUTAN TIDAK DALAM TRAYEK</b></p>
    <p><b>JENIS PELAYANAN ANGKUTAN SEWA KHUSUS</b></p>
    <p><b style="font-size: 12pt;">Nomor :{{$data->no_kp}}</b></p>
  </div>
  <br>
  <div>
    <p class="jstfy">Berdasarkan Surat Keputusan Gubernur Bali Nomor : <b>{{$data->no_sk_gub}}</b> Tanggal <b>{{Fungsi::bulanID($data->tgl_sk_gub)}}</b> tentang izin Penyelenggaraan Angkutan Orang Tidak Dalam Trayek Pelayanan Angkutan Orang Dengan Menggunakan Sewa Khusus Kepada <b>{{$perusahaan->nama_perusahaan}}</b></p>
  </div>
  <br>
  <table cellpadding="10">
    <tr>
      <td>Yang dipimpin oleh</td>
      <td>:</td>
      <td style="text-transform: uppercase;"><b>{{$perusahaan->pemimpin}}</b></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td style="text-transform: uppercase;"><b>{{$perusahaan->alamat}}</b></td>
    </tr>
    <tr>
      <td>Wilayah Operasi</td>
      <td>:</td>
      <td><b>Seluruh Bali</b></td>
    </tr>
  </table>
  <br>
  <div>
    <p class="jstfy">Oleh Kepala Dinas Perhubungan Provinsi Bali, diberikan Kartu Pengawasan Angkutan Tidak Dalam Trayek Jenis Pelayanan Angkutan Sewa Khusus dari Tanggal <b>{{Fungsi::bulanID($data->tgl_ditetapkan).' s/d '.Fungsi::bulanID(date('Y-m-d', strtotime($data->tgl_ditetapkan." +1 year")))}}</b></p>
    <p>Untuk keperluan tersebut dipergunakan mobil penumpang yang diuraikan sebagai berikut :</p>
  </div>
  <br>
  <table style="border: 1px solid black; border-spacing: 0px; width: 100%" cellpadding="5">
    <thead>
      <tr>
        <th colspan="10" style="border-bottom: 1px solid black;" align="center"><b>Identitas Kendaraan</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td width="129px">No. Kendaraan</td>
        <td width="1px">:</td>
        <td style="text-transform: uppercase;"><b>{{$data->no_kendaraan}}</b></td>
        <td width="79px">Nomor Uji</td>
        <td width="1px">:</td>
        <td style="text-transform: uppercase;"><b>{{$data->nomor_uji}}</b></td>
        <td width="99px">Daya Orang</td>
        <td width="1px">:</td>
        <td style="text-transform: uppercase;" width="1px"><b>{{$data->daya_orang}}</b></td>
        <td width="1px">Or</td>
      </tr>
      <tr>
        <td>Tahun Kendaraan</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->tahun_kendaraan}}</b></td>
        <td>Isi Silinder</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->isi_silinder}}</b></td>
        <td>Daya Barang</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->daya_barang}}</b></td>
        <td>Kg</td>
      </tr>
      <tr>
        <td>Merek Kendaraan</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$merk->merk}}</b></td>
        <td>JBI</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->jbi}}</b></td>
        <td>No. Lambung</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->nolambung}}</b></td>
        <td></td>
      </tr>
      <tr>
        <td>Jenis Kendaraan</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$jeniskendaraan->jenis}}</b></td>
        <td></td>
      </tr>
      <tr>
        <td>Warna Kendaraan</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$warna->warna}}</b></td>
        <td></td>
      </tr>
      <tr>
        <td>Pemilik</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{$data->pemilik}}</b></td>
        <td>Alamat</td>
        <td>:</td>
        <td style="text-transform: uppercase;" colspan="5"><b>{{$data->alamat}}</b></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </tbody>
  </table>
  <br><br><br>
  <div class="row">
    <div style="float: left; width: 270px; padding: 5px; border:1px solid black;">
      <b>Agar Diperpanjang / Daftar Ulang</b>
      <br><b>Kembali Pada : </b>
      <br><br>
      <br><b>Tanggal : {{Fungsi::bulanID(date('Y-m-d', strtotime($data->tgl_ditetapkan." +1 year")))}}</b>
    </div>
    <div style="float: right; width: 380px;">
      <table>
        <tr>
          <td>Ditetapkan di</td>
          <td>:</td>
          <td>Denpasar</td>
        </tr>
        <tr>
          <td>Pada Tanggal</td>
          <td>:</td>
          <td>{{Fungsi::bulanID($data->tgl_ditetapkan)}}</td>
        </tr>
      </table>
    </div>
    <div style="float: right; width: 400px;">
      <br><b>an. Gubernur Bali</b>
    </div>
    <div style="float: right; width: {{$data->tgl_ditetapkan >= '2019-02-06' ? '380' : '380'}}px;">
      <b>{{$data->tgl_ditetapkan >= '2019-02-06' ? '' : ''}} Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Provinsi Bali</b>
      <br><br><br><br>
      <br><u><b style="font-family: Times New Roman, Times, serif; text-transform: uppercase;">{{$setting->kadis}}</b></u>
      <br>{{$setting->jabatan}}
      <br>NIP. {{$setting->nip}}
    </div>
  </div>
  <div style='page-break-after:always'></div>
  @for ($i = 0; $i < 4; $i++) <div style="font-size: 12pt; text-align: center;">
    <p><b>DAFTAR ULANG : {{$daftarulang[$i]}}</b></p>
    <p><b>KARTU PENGAWASAN NOMOR : {{$data->no_kp}}</b></p>
    </div>
    Dari tanggal <b>{{Fungsi::bulanID(date($data->detil[$i+1]->tgl_perpanjangan)).' s/d '.Fungsi::bulanID(date('Y-m-d', strtotime($data->detil[$i+1]->tgl_perpanjangan." +1 year")))}}</b>
    <br>No. Kendaraan : <b>{{$data->no_kendaraan}}</b>
    <div class="row">
      <div style="float: right; width: 380px; text-align: center;">
        Ditetapkan di : Denpasar Pada Tanggal :
        <br>
        <br>an. KEPALA DINAS PERHUBUNGAN PROVINSI BALI
        <br>kEPALA BIDANG ANGKUTAN JALAN
      </div>
    </div>
    <div class="row">
      <div style="float: left; width: 270px; padding: 5px; border:1px solid black;">
        <b>Agar Diperpanjang / Daftar Ulang</b>
        <br><b>Kembali Pada : </b>
        <br><br>
        <br><b>Tanggal : {{Fungsi::bulanID(date('Y-m-d', strtotime($data->detil[$i+1]->tgl_perpanjangan." +1 year")))}}</b>
      </div>
    </div>
    <br>
    @endfor
</body>


</html>