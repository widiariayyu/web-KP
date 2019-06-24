@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Data User</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> RBAC</li>
    <li class="active">User</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data User</h3>
          <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah User</button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Username</th>
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
              <label for="name" class="control-label">Nama User</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Nama User" required>
            </div>
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username User" required>
            </div>
            <div class="form-group">
              <label for="role" class="control-label">Username</label>
              <select class="form-control" name="role" id="role" required style="width: 100%;"></select>
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

  <div class="modal fade" id="modal-reset">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <form id="form-reset" action="{{ route('user.reset') }}" method="post">
        {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Konfirmasi Reset Password</h4>
          </div>
          <div class="modal-body">
            <input id="resetid" type="hidden" name="id" value="">
            <input id="resetusername" type="hidden" name="username" value="">
            <p>Yakin ingin melakukan reset password untuk user <strong id="resettext"></strong> ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <input type="submit" id="submit-reset" class="btn btn-danger" value="Reset">
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
	      ajax: '{!! route('user.get') !!}',
	      columns: [
	          { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'roles[0].nama_role', name: 'roles[0].nama_role'},
	          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $("#role").select2({
      placeholder: "Pilih Role...",
      allowClear: false,
      ajax: {
        url: '{{ route("role.select") }}',
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
      $('#modal form').attr('action', "{{ route('user.store') }}");
      $('.modal-title').text('Tambah Data User');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      var role = new Option(data.roles[0].nama_role, data.roles[0].id, false, false);
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/rbac/user') }}/" + data.id);
      $('input[name=name]').val(data.name);
      $('input[name=username]').val(data.username);
      $('#role').append(role).trigger('change');
      $('.modal-title').text('Edit Data User : ' + data.username);
    });

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });

    $('#table tbody').on( 'click', '#btnreset', function () {
      var data = table.row($(this).parents('tr')).data();
      $('#resetid').val(data.id);
      $('#resetusername').val(data.username);
      $('#resettext').text(data.username);
    });

  });
</script>
@stop