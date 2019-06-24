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
  <h3>Periode : {{ date_format(date_create($tglawal),"d-m-Y").' s/d '.date_format(date_create($tglakhir),"d-m-Y") }}</h3>
  @php
    $pribadi = 0;
    $umum = 0;
    $total = 0;
  @endphp
  @foreach ($perusahaans as $perusahaan)
    <br>
    <table class="garis" width="100%">
      <thead>
        <tr>
          <th align="center" colspan="6">{{ $perusahaan->nama_perusahaan }}</th>
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
        {{ $ppribadi = 0 }}
        {{ $pumum = 0 }}
        {{ $ptotal = 0 }}
        @foreach ($kps as $kp)
          @if ($kp->mperusahaan_id == $perusahaan->id)
            <tr>
              <td>{{ $kp->no_kendaraan }}</td>
              <td>{{ $kp->no_sk_gub }}</td>
              <td>{{ date_format(date_create($kp->tgl_sk_gub),"d-m-Y") }}</td>
              <td>{{ $kp->no_kp }}</td>
              <td>{{ date_format(date_create($kp->tgl_ditetapkan),"d-m-Y") }}</td>
              <td>{{ $kp->statusawalkendaraan->status_awal }}</td>
            </tr>
            @php
              $ptotal++;
              $total++;
              if ($kp->mstatusawalkendaraan_id == 1) {
                $ppribadi++;
                $pribadi++;
              }
              if ($kp->mstatusawalkendaraan_id == 2) {
                $pumum++;
                $umum++;
              }
            @endphp
          @endif
        @endforeach
        @if ($ptotal == 0)
          <tr><td align="center" colspan="6">Tidak Ada Data</td></tr>
        @endif
      </tbody>
    </table>
    <table align="right">
      <tbody>
        <tr>
          <td><b>Dari Umum</b></td><td> : {{$pumum}} &nbsp;&nbsp;</td>
          <td><b>Dari Pribadi</b></td><td> : {{$ppribadi}} &nbsp;&nbsp;</td>
          <td><b>Total</b></td><td> : {{$ptotal}}</td>
        </tr>
      </tbody>
    </table>
  @endforeach
  <br>
  <table class="garis" align="center">
    <thead>
      <tr>
        <th colspan="2">Total Jumlah Semua Kendaraan</th>
      </tr>
    </thead>
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