<html>
<style>
	@page :first {
		margin: 10px;
	    background: url("{{ asset('image/kartu/depan-baru.jpg') }}");
			background-image-resize: 6;
	}
	@page {
	    margin: 10px;
	    background: url("{{ asset('image/kartu/belakang.jpg') }}");
			background-image-resize: 6;
	}
	td {
    font-family: "Courier New";
		font-size: 9px;
	}
</style>
<head>
  <title>Kartu Pengawasan Nomor : {{$data->no_kp}}</title>
</head>
<body>
	<div style="width:100%; padding-right:90px; padding-left:75px;">
		<p style="color: white; font-family: Arial, sans-serif; font-size: 10px; text-align:center; padding-top:7px;">
				{{$jos['nama']}}
		</p>
	</div>
  <div style="position: absolute; bottom: 24px; right: 18px;">
    <barcode code="{{$data->kode}}" size="0.7" type="QR" error="M" class="barcode" disableborder="true"/>
  </div>
  <div style="position: absolute; top: 97px; left: 12px;">
    <table width="80%">
			<tr><td>{{ $data->no_kp }}</td></tr>
			<tr><td></td></tr>
      <tr><td>{{ $data->no_kendaraan }}</td></tr>
      <tr><td>{{ $data->pemilik }}</td></tr>
      <tr><td>{{ $data->perusahaan->nama_perusahaan }}</td></tr>
      <tr><td>{{ date('d-m-Y', strtotime($data->tgl_sk_gub)). " s/d " .date('d-m-Y', strtotime($data->tgl_akhir." +1 year")) }}</td></tr>
    </table>
  </div>
  <div style='page-break-after:always'></div>
</body>
</html>
