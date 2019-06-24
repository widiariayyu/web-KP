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
    th, td {
      padding: 0px;
      text-align: left;
      vertical-align: top;
    }
    .header{
      text-align: center;
    }
    .jstfy {
      text-indent: 50px;
      text-align: justify;
      text-justify: inter-word;
    }
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
  </style>
  <title>Surat Perubahan Sifat - {{$data->no_surat_permohonan}}</title>
</head>
<body>
  <p align="right" style="margin-right: 50px;">
    Denpasar, {{Fungsi::bulanID($data->tgl_peremajaan)}}
  </p>
  <br>
  <table style="width:100%; padding-left: 10px;">
    <tr>
      <td style="width:12%;">Nomor</td>
      <td style="width:3%;"> : </td>
      <td style="text-transform: uppercase; width:39%;">{{$data->no_peremajaan}}</td>
      <td style="width:1%;"></td>
      <td style="width:5%;"></td>
      <td style="width:35%;">K e p a d a</td>
    </tr>
    <tr>
      <td>Klasifikasi</td>
      <td> : </td>
      <td>Biasa</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>Lampiran</td>
      <td> : </td>
      <td>1 (satu) Gabung</td>
      <td></td>
      <td>Yth.</td>
      <td style="text-transform: uppercase;"><b>{{$data->perusahaan}}</b></td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td> : </td>
      <td>Rekomendasi Peremajaan Sekaligus</td>
      <td></td>
      <td></td>
      <td><b>Di -</b></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td>Perubahan Sifat Angkutan Sewa Khusus.</td>
      <td></td>
      <td></td>
      <td style="text-transform: uppercase; padding-left:30px;"><b><u>{{$data->wilayah}}</u></b></td>
    </tr>
  </table>
  <br>
  <div style="padding-left: 100px;">
    <table style="width:100%; padding-left: 15px;">
      <tr>
        <td style="width:5%;">1.</td>
        <td class="jstfy">Menunjuk Surat Permohonan dari <b style="text-transform: uppercase;">{{$data->perusahaan}}</b> Nomor {{$data->no_surat_permohonan}} tanggal {{Fungsi::bulanID($data->tgl_surat_permohonan)}}, Tentang Permohonan Peremajaan Kendaraan Angkutan Sewa Umum.</td>
      </tr>
      <tr>
        <td>2.</td>
        <td class="jstfy">Sehubungan dengan hal tersebut diatas, pada prinsipnya kami tidak keberatan dengan permohonan saudara tentang Peremajaan Kendaraan Angkutan Sewa Umum.</td>
      </tr>
      <tr>
        <td></td>
        <td>
          <table style="margin-top:10px; margin-bottom:10px;">
            <tr>
              <td style="width:40%;">Nomor Kendaraan</td>
              <td style="width:2%;"> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_kendaraan_lama}}</td>
            </tr>
            <tr>
              <td>Nomor Uji Kendaraan</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_uji_kendaraan_lama}}</td>
            </tr>
            <tr>
              <td>T a h u n</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->tahun_kendaraan_lama}}</td>
            </tr>
            <tr>
              <td>M e r k</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->merklama}}</td>
            </tr>
            <tr>
              <td>Nomor Kartu Pengawasan</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_kp}}</td>
            </tr>
            <tr>
              <td>Nama Perusahaan</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->perusahaan}}</td>
            </tr>
            <tr>
              <td>A l a m a t</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->alamat_perusahaan}}</td>
            </tr>
            <tr>
              <td><br></td>
            </tr>
            <tr>
              <td>Digantikan dengan kendaraan</td>
              <td> : </td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Nomor Faktur</td>
              <td> : </td>
              <td style="text-transform: uppercase;">{{$data->no_faktur}}</td>
              <td>Tanggal : {{$data->tgl_faktur ? Fungsi::bulanID($data->tgl_faktur) : '-'}}</td>
            </tr>
            <tr>
              <td>Nomor Kendaraan</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_kendaraan}}</td>
            </tr>
            <tr>
              <td>T a h u n</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->tahun_kendaraan}}</td>
            </tr>
            <tr>
              <td>Model / Merk</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->merkbaru}}</td>
            </tr>
            <tr>
              <td>Nomor Mesin</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_mesin}}</td>
            </tr>
            <tr>
              <td>Nomor Rangka</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->no_rangka}}</td>
            </tr>
            <tr>
              <td>Nama Pemilik</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->pemilik}}</td>
            </tr>
            <tr>
              <td>A l a m a t</td>
              <td> : </td>
              <td colspan="2" style="text-transform: uppercase;">{{$data->alamat}}</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>3.</td>
        <td>Kendaraan yang telah diremajakan menjadi kendaraan <b>tidak umum / pribadi</b></td>
      </tr>
      <tr>
        <td>4.</td>
        <td>Demikian disampaikan untuk menjadi maklum.</td>
      </tr>
    </table>
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
    <u><b>Tembusan Yth. :</b></u>
    <br>1. Gubernur Bali (sebagai laporan);
    <br>2. Direktur Lalu Lintas Polda Bali;
    <br>3. Kepala Badan Pendapatan Daerah Provinsi Bali;
    <br>4. Kepala Dinas Perhubungan {{$data->id == 1 ? 'Kota' : 'Kab.'}} {{$data->wilayah}} di {{$data->kota}};
    <br>5. Kasubdit Min Regident Ditlantas Polada Bali;
    <br>6. Kepala UPT. Badan Pendapatan Daerah Provinsi Bali {{$data->id == 1 ? 'Kota' : 'Kab.'}} {{$data->wilayah}} di {{$data->kota}};
    <br>7. Ketua DPD Organda Bali.
  </div>
</body>
</html>
