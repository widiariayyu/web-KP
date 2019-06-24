@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Perpanjangan / Daftar Ulang Angkutan Sewa Khusus</h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Perpanjangan</li>
  </ol>
@stop

@section('content')
  @include('notif')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Masukan No. Kartu/ Scan QR Code</h3>
        </div>
        <div class="box-body">
          <input class="form-control input-lg" type="text" id="nokartu">
        </div>
      </div>
    </div>
  </div>
	<div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Identitas</h3>
        </div>
        <div class="box-body">
          <dl>
            <dt>Pemegang Ijin</dt>
            <dd id="a_perusahaan"></dd>
            <dt>Alamat</dt>
            <dd id="a_alamat"></dd>
            <dt>No. Telepon</dt>
            <dd id="a_telp"></dd>
          </dl>
        </div>
        <div class="box-header with-border">
          <h3 class="box-title">Status</h3>
        </div>
        <div class="box-body">
          <dl>
            <dt>Tanggal Registrasi</dt>
            <dd id="a_tgl_regis"></dd>
            <dt>Tanggal Jatuh tempo Perpanjangan</dt>
            <dd id="a_tgl_jatuh"></dd>
            <dt>Sisa Hari</dt>
            <dd id="a_sisa"></dd>
          </dl>
        </div>
        <div class="box-footer">
          <button class="btn btn-primary pull-right" id="bayar" disabled>Bayar</button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Perpanjangan</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>Tgl Pembayaran</th>
                  <th>Tgl Jatuh Tempo</th>
                  <th>Terlambat</th> 
                  <th>Bayar</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
<script type="text/javascript">
	$( document ).ready(function() {
    var detilid;
    $('#nokartu').focus();
	  var table = $('#table').DataTable({
	      processing: true,
	      serverSide: true,
        // responsive: true,
        paging: false,
        info: false,
        searching: false,
	      ajax: '{!! url('perpanjangan/ask/detail') !!}',
	      columns: [
	          { data: 'tgl_bayar', name: 'tgl_bayar' },
            { data: 'tgl_perpanjangan', name: 'tgl_perpanjangan' },
            { data: 'lambat', name: 'lambat' },
            { data: 'bayar', name: 'bayar' }
	      ]
	  });

    $('#nokartu').keypress(function(e) {
      if(e.which == 13) {
        var id = $(this).val();
        dataload(id);
      }
    });

    function dataload(id) {
      var url;
      if (id != '') {
        $.get("{{url('perpanjangan/ask/getdata')}}/"+id, function(data){
          if (data.nolambung) {
            url = "{{url('perpanjangan/ask/detail')}}/"+id;
            table.ajax.url(url).load();
            $('#a_perusahaan').text(data.perusahaan.nama_perusahaan);
            $('#a_alamat').text(data.perusahaan.alamat);
            $('#a_telp').text(data.perusahaan.telp);
            $('#a_tgl_regis').text(data.tgl_sk_gub);
            $('#a_tgl_jatuh').text(data.jatuh_tempo);
            $('#a_sisa').text(data.sisa);
            detilid = data.detilid;
            if (data.detilid != '') { $('#bayar').removeAttr('disabled'); }
          }else{
            url = '{!! url('perpanjangan/ask/detail') !!}';
            table.ajax.url(url).load();
            $('#bayar').attr('disabled', 'true');
          }
        });
      }
    }

    $('#bayar').click(function(e) {
      var id = detilid;
      if (id != '') {
        $.get("{{url('perpanjangan/ask/bayar')}}/"+id, function(data){
          if (data != 'gagal') {
            console.log(data)
            dataload(data);
            alert("Pembayaran Berhasil");
          }else{
            alert("Gagal Membayar");
          }
        });
      }else{
        alert("Sudah 5 kali");
      }
    });
  });
</script>
@stop