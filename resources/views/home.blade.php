@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@include('notif')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Kartu Pengawasan Jatuh Tempo</h3>
    <div class="box-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <input type="number" id="hari" class="form-control pull-right" value="30" min="0" required></input>
        <div class="input-group-btn">
          <button type="button" id="btn-cari-hari" class="btn btn-default"><i class="fa fa-search"></i></button>
          <button type="button" id="btn-sms-sebelum" class="btn bg-olive"><i class="fa fa-paper-plane"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-striped table-condensed" cellspacing="0" width="100%" id="table-kp-sebelum">
        <thead>
          <tr>
            <th>No. Kartu Pengawasan</th>
            <th>No. Kendaraan</th>
            <th>Perusahaan</th>
            <th>Pemilik</th>
            <th>Tgl Perpanjangan</th>
            <th>Sisa</th>
            <th>No. Telepon</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Kartu Pengawasan Melewati Jatuh Tempo</h3>
    <div class="box-tools">
        <button type="button" id="btn-sms-lewat" class="btn btn-sm bg-olive"><i class="fa fa-paper-plane"></i> Kirim SMS</button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-striped table-condensed" cellspacing="0" width="100%" id="table-kp-lewat">
        <thead>
          <tr>
            <th>No. Kartu Pengawasan</th>
            <th>No. Kendaraan</th>
            <th>Perusahaan</th>
            <th>Pemilik</th>
            <th>Tgl Perpanjangan</th>
            <th>Lewat</th>
            <th>No. Telepon</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

@stop

@section('js')
<script src="{{ asset('plugins/Chartjs/Chart.min.js') }}"></script>
<script>
  $( document ).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var table_kp_sebelum = $('#table-kp-sebelum').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home.dt.kp.belum', ['hari' => 30]) }}",
        columns: [
            { data: 'no_kp', name: 'no_kp' },
            { data: 'no_kendaraan', name: 'no_kendaraan' },
            { data: 'nama_perusahaan', name: 'nama_perusahaan' },
            { data: 'pemilik', name: 'pemilik' },
            { data: 'tgl_perpanjangan', name: 'tgl_perpanjangan' },
            { data: 'sisa', name: 'sisa' },
            { data: 'phone_number', name: 'phone_number' }
        ]
    });
    
    function loadDT() {
      var hari = $('#hari').val();
      if (isNaN(hari)) {
        hari = 0;
      }
      table_kp_sebelum.ajax.url("{{ url('home/dt/sebelum') }}/"+hari).load();
    }

    $('#hari').keydown(function(e){
      if(e.which == 13) {
        loadDT();
      }
    });

    $('#btn-cari-hari').click(function(){
      loadDT();
    });

    $('#btn-sms-sebelum').click(function () {
      if (table_kp_sebelum.rows().data().length > 0) {
        var kp = table_kp_sebelum.data().toArray();
        $.ajax({
          url: "{{ route('sms.kp.sebelum') }}",
          type: 'POST',
          data: {_token: CSRF_TOKEN, kp:kp},
          dataType: 'JSON',
          success: function (data) {
            console.log(data);
          }
        });
      }else{
        alert('Tidak Ada Data');
      }
    });





    var table_kp_lewat = $('#table-kp-lewat').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home.dt.kp.lewat') }}",
        columns: [
          { data: 'no_kp', name: 'no_kp' },
          { data: 'no_kendaraan', name: 'no_kendaraan' },
          { data: 'nama_perusahaan', name: 'nama_perusahaan' },
          { data: 'pemilik', name: 'pemilik' },
          { data: 'tgl_perpanjangan', name: 'tgl_perpanjangan' },
          { data: 'lewat', name: 'lewat' },
          { data: 'phone_number', name: 'phone_number' }
        ]
    });

    $('#btn-sms-lewat').click(function () {
      if (table_kp_lewat.rows().data().length > 0) {
        var kp = table_kp_lewat.data().toArray();
        $.ajax({
          url: "{{ route('sms.kp.lewat') }}",
          type: 'POST',
          data: {_token: CSRF_TOKEN, kp:kp},
          dataType: 'JSON',
          success: function (data) {
            console.log(data);
          }
        });
      }else{
        alert('Tidak Ada Data');
      }
    });
  });
</script>
@stop
