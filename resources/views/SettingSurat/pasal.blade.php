@extends('adminlte::pageAdmin')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Setting Pasal Permen</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Setting</li>
    <li class="active">Pasal Permen</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Setting Pasal Permen</h3>
          <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah Pasal Permen</button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>Pasal Permen</th>
                  <th>No. Permen</th>
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
              <label for="pasalpermen" class="control-label">Pasal Peraturan Mentri</label>
              <input type="text" class="form-control" name="pasalpermen" id="pasalpermen" placeholder="Pasal Permen" required>
            </div>
            <div class="form-group">
              <label for="nopermen" class="control-label">No. Peraturan Mentri</label>
              <input type="text" class="form-control" name="nopermen" id="nopermen" placeholder="Nomor Permen" required>
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
	      ajax: '{!! route('pasal.get') !!}',
	      columns: [
            { data: 'pasal_permen', name: 'pasal_permen' },
            { data: 'no_permen', name: 'no_permen' },
	          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $('#btntambah').on('click', function(){
      $('input[name=_method]').val('POST');
      $('#modal form').attr('action', "{{ route('pasal.store') }}");
      $('.modal-title').text('Tambah Data Setting Surat Kepala Dinas');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      id = data.id;
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/m/pasal') }}/" + id);
      $('input[name=pasalpermen]').val(data.pasal_permen);
      $('input[name=nopermen]').val(data.no_permen);
      $('.modal-title').text('Edit Data Setting Surat : ' + data.no_surat_kadis);
    });

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });

  });
</script>
@stop
