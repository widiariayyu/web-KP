@extends('adminlte::page')

@section('title', 'Status Awal Kendaraan')

@section('content_header')
  <h1>Data Status Awal Kendaraan</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Master Data</li>
    <li class="active">Status Awal Kendaraan</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Status Awal Kendaraan</h3>
          <div class="box-tools">
            <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> Tambah Status Awal Kendaraan</button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped" cellspacing="0" width="100%" id="table">
              <thead>
                <tr>
                  <th>Status Awal Kendaraan</th>
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
              <label for="status_awal" class="control-label">Status Awal Kendaraan</label>
              <input type="text" class="form-control" name="status_awal" id="status_awal" placeholder="Nama Status Awal Kendaraan Kendaraan" required>
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
	      ajax: '{!! route('sak.get') !!}',
	      columns: [
	          { data: 'status_awal', name: 'status_awal' },
	          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });

    $('#btntambah').on('click', function(){
      $('input[name=_method]').val('POST');
      $('#modal form').attr('action', "{{ route('sak.store') }}");
      $('.modal-title').text('Tambah Data Status Awal Kendaraan');
    })

    $('#table tbody').on('click', '#btnedit', function () {
      var data = table.row($(this).parents('tr')).data();
      id = data.id;
      var sak = data.status_awal;
      $('input[name=_method]').val('PUT');
      $('#modal form').attr('action', "{{ URL('/m/sak') }}/" + id);
      $('input[name=status_awal]').val(sak);
      $('.modal-title').text('Edit Data Status Awal Kendaraan : ' + sak);
    });

    // $('input[name=merk]').on('input change focusout', function () {
    //   validasiunik(id, $(this).val());
    // });

    // function validasiunik(id, name) {
    //   var _token = $("input[name='_token']").val();
    //   $.ajax({
    //       url: "",
    //       type:'POST',
    //       data: {_token:_token, name:name, id:id},
    //       success: function(data) {
    //           if($.isEmptyObject(data.error)){
    //             $("input[type=submit]").removeAttr('disabled');
    //           }else{
    //             $("input[type=submit]").attr('disabled','disabled');
    //             pesanerror(data.error);
    //           }
    //       }
    //   }); 
    //   $.get(ajxurl, function(data){
    //       if(data){
    //         $("input[name="+name+"]").closest('.form-group').addClass('has-error');
    //         $("button[type=submit]").attr('disabled','disabled');
    //       }
    //   });
    // };

    $('#modal').on('hidden.bs.modal', function () {
      $('#modal form')[0].reset();
    });

  });
</script>
@stop