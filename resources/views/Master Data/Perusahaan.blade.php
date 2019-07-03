@extends('adminlte::pageAdmin')

@section('title', 'Perusahaan')

@section('content_header')
  <h1>Data Perusahaan Angkutan Sewa Khusus</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Master Data</li>
    <li>Perusahaan</li>
    <li class="active">Angkutan Sewa Khusus</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Perusahaan</h3>
          <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah Perusahaan</button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Kategori</th>
                  <th>Nama</th>
                  {{-- <th>Pemimpin</th> --}}
                  <th>Alamat</th>
                  <th>Wilayah</th>
                  {{-- <th>No. Badan Hukum</th> --}}
                  <th>No. Telepon</th>
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
              <label for="katperusahaan" class="control-label">Kategori Perusahaan</label>
              <select class="form-control" name="katperusahaan" id="katperusahaan" required style="width: 100%;"></select>
            </div>
            <div class="form-group">
              <label for="nama" class="control-label">Nama Perusahaan</label>
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Perusahaan" required>
            </div>
            <div class="form-group">
              <label for="pemimpin" class="control-label">Nama Pemimpin Perusahaan</label>
              <input type="text" class="form-control" name="pemimpin" id="pemimpin" placeholder="Nama Pemimpin Perusahaan" required>
            </div>
            <div class="form-group">
              <label for="alamat" class="control-label">Alamat Perusahaan</label>
              <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Perusahaan" required>
            </div>
            <div class="form-group">
              <label for="wilayah" class="control-label">Wilayah</label>
              <select class="form-control" name="wilayah" id="wilayah" required style="width: 100%;"></select>
            </div>
            <div class="form-group">
              <label for="badanhukum" class="control-label">No. Badan Hukum</label>
              <input type="text" class="form-control" name="badanhukum" id="badanhukum" placeholder="Nomor Badan Hukum Perusahaan" required>
            </div>
            <div class="form-group">
              <label for="badanhukum" class="control-label">No. Telepon</label>
              <input type="text" class="form-control" name="telp" id="telp" placeholder="Nomor Telepon Perusahaan" required>
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
	      ajax: '{{ route('perusahaan.get') }}',
	      columns: [
          { data: 'id', name: 'id' },
          { data: 'katperusahaan.kategori_perusahaan', name: 'katperusahaan.kategori_perusahaan' },
          { data: 'nama_perusahaan', name: 'nama_perusahaan' },
          // { data: 'pemimpin', name: 'pemimpin' },
          { data: 'alamat', name: 'alamat' },
          { data: 'wilayah.wilayah', name: 'wilayah.wilayah' },
          // { data: 'no_badan_hukum', name: 'no_badan_hukum' },
          { data: 'telp', name: 'telp' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $("#katperusahaan").select2({
      placeholder: "Pilih Kategori Perusahaan...",
      allowClear: false,
      ajax: {
          url: '{{ route("katperusahaan.select") }}',
          dataType: 'json',
          data: function (params) {
              return {
                  q: $.trim(params.term)
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
    });
    $("#wilayah").select2({
      placeholder: "Pilih Wilayah Perusahaan...",
      allowClear: false,
      ajax: {
          url: '{{ route("wilayah.select") }}',
          dataType: 'json',
          data: function (params) {
              return {
                  q: $.trim(params.term)
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
    });

    $('#btntambah').on('click', function(){
      $('input[name=_method]').val('POST');
      $('#modal form').attr('action', "{{ route('perusahaan.store') }}");
      $('.modal-title').text('Tambah Data Perusahaan');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      id = data.id;
      var kategori = new Option(data.katperusahaan.kategori_perusahaan, data.katperusahaan.id, false, false);
      var wilayah = new Option(data.wilayah.wilayah, data.wilayah.id, false, false);
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/m/perusahaan') }}/" + id);
      $('input[name=nama]').val(data.nama_perusahaan);
      $('input[name=pemimpin]').val(data.pemimpin);
      $('input[name=alamat]').val(data.alamat);
      $('input[name=badanhukum]').val(data.no_badan_hukum);
      $('input[name=telp]').val(data.telp);
      $('#katperusahaan').append(kategori).trigger('change');
      $('#wilayah').append(wilayah).trigger('change');
      $('.modal-title').text('Edit Data Perusahaan : ' + data.nama_perusahaan);
    });

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });

  });
</script>
@stop
