@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Data Role</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> RBAC</li>
    <li class="active">Role</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Role</h3>
          <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah Role</button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Permission</th>
                  <th>Role</th>
                  <th style="width:120px;"></th>
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
              <label for="nama_role" class="control-label">Rolename</label>
              <input type="text" class="form-control" name="nama_role" id="nama_role" placeholder="Rolename Role" required>
            </div>
            <div class="form-group">
              <label for="permission" class="control-label">Rolename</label>
              <select multiple="multiple" class="form-control" name="permission" id="permission" required style="width: 100%;"></select>
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
	  var table = $('#table').DataTable({
	      processing: true,
	      serverSide: true,
	      ajax: '{!! route('role.get') !!}',
	      columns: [
	          { data: 'nama_role', name: 'nama_role' },
            { data: 'permission', name: 'permission' },
	          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $("#permission").select2({
      placeholder: "Pilih permission...",
      allowClear: false,
      ajax: {
        url: '{{ route("permission.select") }}',
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
      $('#modal form').attr('action', "{{ route('role.store') }}");
      $('.modal-title').text('Tambah Data Role');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      var role = new Option(data.roles[0].nama_role, data.roles[0].id, false, false);
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/rbac/role') }}/" + data.id);
      $('input[name=name]').val(data.name);
      $('input[name=nama_role]').val(data.nama_role);
      $('#role').append(role).trigger('change');
      $('.modal-title').text('Edit Data Role : ' + data.nama_role);
    });

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });
  });
</script>
@stop