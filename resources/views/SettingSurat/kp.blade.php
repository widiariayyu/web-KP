@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Setting Surat Kartu Pengawasan</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Setting Surat</li>
    <li class="active">Kartu Pengawasan</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Setting Surat Kartu Pengawasan</h3>
          {{-- <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah Setting Surat</button>
          </div> --}}
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>No. Surat Kartu Pengawasan 1</th>
                  <th>No. Surat Kartu Pengawasan 2</th>
                  <th>No. Surat Kartu Pengawasan 3</th>
                  <th>Kadis</th>
                  <th>Jabatan</th>
                  <th>NIP</th>
                  <th>Biaya</th>
                  <th>Tahun Kendaraan</th>
                  <th style="width:60px;"></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" data-toggle="validator" action="" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="kp1" class="control-label">No. Surat Kartu Pengawasan 1</label>
              <input type="text" class="form-control" name="kp1" id="kp1" placeholder="Nomor Surat Kartu Pengawasan 1" required>
            </div>
            <div class="form-group">
              <label for="kp2" class="control-label">No. Surat Kartu Pengawasan 2</label>
              <input type="text" class="form-control" name="kp2" id="kp2" placeholder="Nomor Surat Kartu Pengawasan 2" required>
            </div>
            <div class="form-group">
              <label for="kp3" class="control-label">No. Surat Kartu Pengawasan 3</label>
              <input type="text" class="form-control" name="kp3" id="kp3" placeholder="Nomor Surat Kartu Pengawasan 3" required>
            </div>
            <div class="form-group">
              <label for="kp3" class="control-label">Nama Kepala Dinas</label>
              <input type="text" class="form-control" name="kadis" id="kadis" placeholder="Nama Kepala Dinas" required>
            </div>
            <div class="form-group">
              <label for="kp3" class="control-label">Jabatan Kepala Dinas</label>
              <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan Kepala Dinas" required>
            </div>
            <div class="form-group">
              <label for="kp3" class="control-label">NIP Kepala Dinas</label>
              <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP Kepala Dinas" required>
            </div>
            <div class="form-group">
              <label for="kp3" class="control-label">Biaya Perpanjangan</label>
              <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Perpanjangan" required>
            </div>
            <div class="form-group">
              <label class="control-label">Tahun Kendaraan</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tahunkendaraan" id="tahunkendaraan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop

@section('js')
<script type="text/javascript">
	$( document ).ready(function() {
    var id;
	  var table = $('#table').DataTable({
	      processing: true,
	      serverSide: true,
	      ajax: '{!! route('setting.get') !!}',
	      columns: [
	          { data: 'nomor_surat_kp_1', name: 'nomor_surat_kp_1' },
            { data: 'nomor_surat_kp_2', name: 'nomor_surat_kp_2' },
            { data: 'nomor_surat_kp_3', name: 'nomor_surat_kp_3' },
            { data: 'kadis', name: 'kadis' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'nip', name: 'nip' },
            { data: 'biaya', name: 'biaya' },
            { data: 'tahunkendaraan', name: 'tahunkendaraan' },
	          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $('#tahunkendaraan').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      drops: "up",
      locale: {
        format: 'YYYY-MM-DD'
      },
    });

    $('#btntambah').on('click', function(){
      $('input[name=_method]').val('POST');
      $('#modal form').attr('action', "{{ route('setting.store') }}");
      $('.modal-title').text('Tambah Data Setting Kartu Pengawasan');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      id = data.id;
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/m/setting') }}/" + id);
      $('input[name=kp1]').val(data.nomor_surat_kp_1);
      $('input[name=kp2]').val(data.nomor_surat_kp_2);
      $('input[name=kp3]').val(data.nomor_surat_kp_3);
      $('input[name=kadis]').val(data.kadis);
      $('input[name=jabatan]').val(data.jabatan);
      $('input[name=nip]').val(data.nip);
      $('input[name=biaya]').val(data.biaya);
      $('input[name=tahunkendaraan]').data('daterangepicker').setStartDate(data.tahunkendaraan);
      $('input[name=tahunkendaraan]').data('daterangepicker').setEndDate(data.tahunkendaraan);
      // $('input[name=tahunkendaraan]').val(data.tahunkendaraan);
      $('.modal-title').text('Edit Data Setting Kartu Pengawasan : ' + data.nomor_surat_kp_1);
    });

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });

  });
</script>
@stop
