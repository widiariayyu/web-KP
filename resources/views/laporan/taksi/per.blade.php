<!DOCTYPE html>
<html>
<head>
  <title>{{ 'KP Taksi - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y") }}</title>
  <style>
    table {
      border-collapse: collapse;
    }

    .garis table, 
    .garis th, 
    .garis td {
      border: 1px solid black;
      padding: 5px;
    }
  </style>
</head>
<body>
  <h1>Laporan Angkutan Taksi</h1>
  <h3>{{$perusahaans->nama_perusahaan}}</h3>
  <h3>Periode : {{ date_format(date_create($tglawal),"d-m-Y").' s/d '.date_format(date_create($tglakhir),"d-m-Y") }}</h3>
  @php
    $pribadi = 0;
    $umum = 0;
    $total = 0;
  @endphp
  <table class="garis" width="100%">
    <thead>
      <tr>
        <th align="center" colspan="6">{{ $perusahaans->nama_perusahaan }}</th>
      </tr>
      <tr>
        <th>No. Kendaraan</th>
        <th>SK Penyelenggaraan</th>
        <th>Tgl Penyelenggaraan</th>
        <th>No. KP</th>
        <th>Tgl Ditetapkan</th>
        <th>Status Dari</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($perusahaans->kps as $kp)
        <tr>
          <td>{{ $kp->no_kendaraan }}</td>
          <td>{{ $kp->no_sk_gub }}</td>
          <td>{{ date_format(date_create($kp->tgl_sk_gub),"d-m-Y") }}</td>
          <td>{{ $kp->no_kp }}</td>
          <td>{{ date_format(date_create($kp->tgl_ditetapkan),"d-m-Y") }}</td>
          <td>{{ $kp->statusawalkendaraan->status_awal }}</td>
        </tr>
        @php
          $total++;
          if ($kp->mstatusawalkendaraan_id == 1) {
            $pribadi++;
          }
          if ($kp->mstatusawalkendaraan_id == 2) {
            $umum++;
          }
        @endphp
      @endforeach
      @if ($total == 0)
        <tr><td align="center" colspan="6">Tidak Ada Data</td></tr>
      @endif
    </tbody>
  </table>
  <br>
  <table class="garis" align="right">
    <tbody>
      <tr>
        <td><b>Dari Umum</b></td><td>{{$umum}}</td>
      </tr>
      <tr>
        <td><b>Dari Pribadi</b></td><td>{{$pribadi}}</td>
      </tr>
      <tr>
        <td><b>Total</b></td><td>{{$total}}</td>
      </tr>
    </tbody>
  </table>
</body>
</html>