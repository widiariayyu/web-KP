@extends('adminlte::page')

@section('title', 'SK Kartu Pengawasan')

@section('content_header')
<h1>Kartu Pengawasan / Kendaraan <small>Angkutan Sewa Khusus</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('ask.kpsk.index') }}"><i class="fa fa-dashboard"></i> SK Kartu Pengawasan</a></li>
    <li class="active">KP</li>
</ol>
@stop

@section('content')
@include('notif')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="description-block border-right">
                            <span class="description-percentage text-green">{{ $sk->NoInduk }}</span>
                            <h5 class="description-header text-left">{{ $sk->perusahaan->nama_perusahaan }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block border-right">
                            <span class="description-text">No. Permohonan</span>
                            <h5 class="description-header">{{ $sk->NoPermohonan }}</h5>
                            <span class="description-percentage text-green"><i class="fa fa-calendar"></i> {{ $sk->TglPermohonan }}</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block border-right">
                            <span class="description-text">SK Pelaksanaan</span>
                            <h5 class="description-header">{{ $sk->SKPelaksanaan }}</h5>
                            <span class="description-percentage text-green"><i class="fa fa-calendar"></i> {{ $sk->TglPelaksanaan }}</span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block border-right">
                            <span class="description-text">SK Penyelenggaraan</span>
                            <h5 class="description-header">{{ $sk->SKPenyelenggaraan }}</h5>
                            <span class="description-percentage text-green"><i class="fa fa-calendar"></i> {{ $sk->TglPenyelenggaraan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Data Kartu Pengawasan / Kendaraan (Angkutan Sewa Khusus)</h3>
                <div class="box-tools">
                    <button type="button" id="btntambah" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="glyphicon glyphicon-plus"></i> KP</button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped" cellspacing="0" width="100%" id="table">
                        <thead>
                            <tr>
                                <th>No. Kendaraan</th>
                                <th>No. KP</th>
                                <th>Tgl. Perpanjangan</th>
                                <th>Status Awal</th>
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
            <form role="form" data-toggle="validator" autocomplete="off" action="{{ route('ask.kpsk.kp.store') }}" method="post">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Tambah KP Kendaraan</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idsk" value="{{ $sk->id }}">
                    <input type="hidden" name="nosk" value="{{ $sk->SKPenyelenggaraan }}">
                    <input type="hidden" name="tglsk" value="{{ $sk->TglPenyelenggaraan }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="warna" class="control-label">Status Awal Kendaraan</label>
                            <select name="sak" class="form-control">
                                @foreach ($sa as $v)
                                    <option value="{{ $v->id }}">{{ $v->status_awal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="warna" class="control-label">No. Kendaraan</label>
                            <input type="text" class="form-control" name="nokendaraan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="warna" class="control-label">No. Kartu Pengawasan</label>
                        <div class="input-group">
                            <span class="input-group-addon">{{ $setting->nomor_surat_kp_1.'.' }}</span>
                            <input type="text" class="form-control" value="{{ $sk->NoInduk }}" name="NoInduk" readonly required style="width: 46px;" title="No. Induk">
                            <span class="input-group-addon">/</span>
                            <input type="text" class="form-control" name="nolambung" data-remote="{{ route('kp.ask.validasi', ['perusahaan' => $sk->IdPerusahaan]) }}" required title="No. Lambung">
                            <span class="input-group-addon">/ASK.</span>
                            <input type="text" class="form-control" value="{{ $sk->IdPerusahaan }}" name="perusahaan" readonly required style="width: 41px;" title="ID Perusahaan">
                            <span class="input-group-addon">/DISHUB-</span>
                            <input type="text" class="form-control" value="{{ date('Y', strtotime($sk->TglPenyelenggaraan)) }}" name="tahun" readonly required title="Tahun Penyelenggaraan">
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
var rawData = {
    route: {
        dtKP: "{{ route('ask.dt.kpsk.kp', ['sk' => $sk->id]) }}",
        valNoLambung: "{{ route('kp.ask.getnolambung', ['perusahaan' => $sk->IdPerusahaan]) }}"
    }
};

$(document).ready(function() {
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: rawData.route.dtKP,
        columns: [
            { data: 'no_kendaraan', name: 'no_kendaraan' },
            { data: 'no_kp', name: 'no_kp' },
            { data: 'tgl1', name: 'tgl1' },
            { data: 'statusawalkendaraan.status_awal', name: 'statusawalkendaraan.status_awal' }
        ]
    });

    function getNoUnik() {
        $.get(rawData.route.valNoLambung, function(data){
            $('input[name=nolambung]').val(data);
        });
    };

    $('#modal').on('show.bs.modal', function (e) {
        getNoUnik();
    });

    $('#modal').on('hidden.bs.modal', function (e) {
        $('input[name=no]').val(null);
        $('input[name=nokendaraan]').val(null);
    });
});
</script>
@stop