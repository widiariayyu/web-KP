@extends('adminlte::page')

@section('title', 'SK Kartu Pengawasan')

@section('content_header')
<h1>SK Kartu Pengawasan <small>Angkutan Sewa Khusus</small></h1>
@stop

@section('content')
@include('notif')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data SK Kartu Pengawasan (Angkutan Sewa Khusus)</h3>
                <div class="box-tools">
                    <a href="{{ route('ask.kpsk.create') }}" type="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Buat SK</a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped" cellspacing="0" width="100%" id="table">
                        <thead>
                            <tr>
                                <th>Perusahaan</th>
                                <th>No Induk</th>
                                <th>No. Permohonan</th>
                                <th>Tgl. Permohonan</th>
                                <th>SK. Penyelenggaraan</th>
                                <th>Tgl. Penyelenggaraan</th>
                                <th style="width:50px;"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
var rawData = {
    route: {
        dtSK: "{{ route('ask.dt.kpsk') }}"
    }
};

$(document).ready(function() {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: rawData.route.dtSK,
        columns: [
            { data: 'perusahaan.nama_perusahaan', name: 'perusahaan.nama_perusahaan' },
            { data: 'NoInduk', name: 'NoInduk' },
            { data: 'NoPermohonan', name: 'NoPermohonan' },
            { data: 'TglPermohonan', name: 'TglPermohonan' },
            { data: 'SKPenyelenggaraan', name: 'SKPenyelenggaraan' },
            { data: 'TglPenyelenggaraan', name: 'TglPenyelenggaraan' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@stop