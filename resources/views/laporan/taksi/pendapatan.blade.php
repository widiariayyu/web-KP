<!DOCTYPE html>
<html>
<head>
  <title>{{ 'KP Taksi Pendapatan - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y") }}</title>
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
  <h1>Laporan Pendapatan Angkutan Taksi</h1>
  <h3>Periode : {{ date_format(date_create($tglawal),"d-m-Y").' s/d '.date_format(date_create($tglakhir),"d-m-Y") }}</h3>
  <table class="garis" width="100%">
    <thead>
      <tr>
        <th>No. KP</th>
        <th>Nama Perusahaan</th>
        <th>No. Kendaraaan</th>
        <th>Ke</th>
        <th>Tgl Perpanjangan</th>
        <th>Bayar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datas as $data)
        <tr>
          <td>{{ $data->no_kp }}</td>
          <td>{{ $data->nama_perusahaan }}</td>
          <td>{{ $data->no_kendaraan }}</td>
          <td>{{ $data->perpanjangan_ke }}</td>
          <td>{{ date_format(date_create($data->tgl_perpanjangan),"d-m-Y") }}</td>
          <td align="right">{{ number_format($data->bayar,0,",",".") }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td align="center" colspan="5"><b>TOTAL</b></td>
        <td align="right"><b>{{ number_format($total,0,",",".") }}</b></td>
      </tr>
    </tfoot>
  </table>
</body>
</html>