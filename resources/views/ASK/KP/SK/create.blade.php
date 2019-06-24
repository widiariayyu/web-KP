@extends('adminlte::page')

@section('title', 'Tambah Sk Kartu Pengawasan')

@section('content_header')
<h1>Tambah SK Kartu Pengawasan <small>Angkutan Sewa Khusus</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('ask.kpsk.index') }}"><i class="fa fa-dashboard"></i> SK Kartu Pengawasan</a></li>
    <li class="active">Tambah</li>
</ol>
@stop

@section('content')
@include('notif')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <form id="form-utama" data-toggle="validator" action="{{ route('ask.kpsk.store') }}" method="POST">
                <div class="box-header with-border">
                    <h3 class="box-title">Form SK Kartu Pengawasan</h3>
                </div>
                <div class="box-body">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">Perusahaan</label>
                            <select class="form-control" name="IdPerusahaan" required style="width: 100%;"></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">No Induk</label>
                            <input type="text" class="form-control" name="NoInduk" readonly required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">Nomor Permohonan</label>
                            <input type="text" class="form-control" name="NoPermohonan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">Tgl Permohonan</label>
                            <input type="text" class="form-control tglpilih" name="TglPermohonan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">SK Peleksanaan</label>
                            <input type="text" class="form-control" name="SKPelaksanaan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">Tgl Pelaksanaan</label>
                            <input type="text" class="form-control tglpilih" name="TglPelaksanaan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">SK Penyelenggaraan</label>
                            <input type="text" class="form-control" name="SKPenyelenggaraan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nokp" class="control-label">Tgl Penyelenggaraan</label>
                            <input type="text" class="form-control tglpilih" name="TglPenyelenggaraan" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
var rawData = {
    select2: {
        perusahaan: "{{ route('perusahaan.select') }}"
    }
};
$(document).ready(function() {
    select2create('select[name=IdPerusahaan]', rawData.select2.perusahaan, 'Pilih Perusahaan');
    tglpilih();

    $('select[name=IdPerusahaan]').on('select2:select', function (e) {
        $('input[name=NoInduk]').val('0' + $(this).val());
    });
});
</script>
@stop