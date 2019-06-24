<!DOCTYPE html>
<html>
<head>
  <title>{{ 'Rekap KP ASK - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y") }}</title>
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
  <h1>Laporan Rekap Angkutan Sewa Khusus</h1>
  <h3>Periode : {{ date_format(date_create($tglawal),"d-m-Y").' s/d '.date_format(date_create($tglakhir),"d-m-Y") }}</h3>
  <table class="garis" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Perusahaan</th>
        <th>Umum</th>
        <th>Pribadi</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datas as $data)  
        <tr>
          <td>{{ $data->id }}</td>
          <td>{{ $data->nama_perusahaan }}</td>
          <td align="center">{{ $data->umum }}</td>
          <td align="center">{{ $data->pribadi }}</td>
          <td align="center">{{ $data->umum + $data->pribadi }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th colspan="2">TOTAL</th>
        <th>{{ $totalumum->umum }}</th>
        <th>{{ $totalpribadi->pribadi }}</th>
        <th>{{ $totalumum->umum + $totalpribadi->pribadi }}</th>
      </tr>
    </tfoot>
  </table>
</body>
</html>