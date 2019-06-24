@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Perubahan Sifat</h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-dashboard"></i> Perubahan Sifat</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Perubahan Sifat</h3>
          <div class="box-tools">
            <a href="{{route('perubahansifat.create')}}" type="button" id="btntambah" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Buat Surat</a>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-striped" cellspacing="0" width="100%" id="table">
            <thead>
              <tr>
                <th>No. Surat</th>
                <th>Perusahaan</th>
                <th>No. Surat Permohonan</th>
                <th>Tgl. Surat Permohonan</th>
                <th>No. Surat Kepala Dinas</th>
                <th>Pemilik Kendaraan</th>
                <th>Jenis</th>
                <th>Merk</th>
                <th style="width:60px;"></th>
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
	      ajax: '{{ route('perubahansifat.get') }}',
	      columns: [
	          { data: 'no_surat_rekomendasi', name: 'no_surat_rekomendasi' },
            { data: 'perusahaan.nama_perusahaan', name: 'perusahaan.nama_perusahaan' },
            { data: 'no_surat_permohonan', name: 'no_surat_permohonan' },
            { data: 'tgl_surat_permohonan', name: 'tgl_surat_permohonan' },
            { data: 'nosuratpenyelenggaraan', name: 'nosuratpenyelenggaraan' },
            { data: 'pemilik', name: 'pemilik' },
            { data: 'jeniskendaraan.jenis', name: 'jeniskendaraan.jenis' },
            { data: 'merk.merk', name: 'merk.merk' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
	  });
  });
</script>
@stop
