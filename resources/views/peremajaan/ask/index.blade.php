@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Peremajaan Kendaraan Sewa Khusus</h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Peremajaan</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Peremajaan</h3>
          <div class="box-tools">
            <a href="{{route('peremajaan.ask.create')}}" type="button" id="btntambah" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Peremajaan</a>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-striped" cellspacing="0" width="100%" id="table">
            <thead>
              <tr>
                <th>No. Peremajaan</th>
                <th>No. Kartu Pengawasan</th>
                <th>Perusahaan</th>
                <th style="width:70px;"></th>
              </tr>
            </thead>
          </table>
        </div>
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
	      ajax: '{{ route('peremajaan.ask.get') }}',
	      columns: [
	          { data: 'no_peremajaan', name: 'no_peremajaan' },
            { data: 'no_kp', name: 'no_kp' },
            { data: 'perusahaan', name: 'perusahaan' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });
  });
</script>
@stop
