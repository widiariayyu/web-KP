@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Ubah Kartu Pengawasan {{$jangkutan}}</h1>
  <ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Kartu Pengawasan</li>
    <li class="active">Ubah</li>
  </ol>
@stop

@section('content')
  @include('notif')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Kartu Pengawasan</h3>
        </div>
        <form id="form-utama" role="form" data-toggle="validator" action="{{ route('kp.'.$angkutan.'.update', ['id' => $data->kode]) }}" method="post">
          {{ csrf_field() }} {{ method_field('PUT') }}
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="sak" class="control-label">Status Awal Kendaraan</label>
                <select disabled class="form-control" name="sak" id="sak" required style="width: 100%;"></select>
              </div>

              @if ($angkutan == 'taksi')
                <div class="form-group col-md-2">
                  <label for="nokp" class="control-label">Nomor KP</label>
                  <input disabled type="text" class="form-control" value="{{ substr($data->no_kp,4,4) }}" name="nokp" placeholder="No Kartu Pengawasan" required>
                </div>
              @endif

              <div class="form-group col-md-{{$angkutan == 'taksi' ? '4' : '6'}}">
                <label for="nosk" class="control-label">Nomor Surat Keputusan</label>
                <input type="text" class="form-control" value="{{ $data->no_sk_gub }}" name="nosk" id="nosk" placeholder="Nomor Surat Keputusan" disabled required>
              </div>

              <div class="form-group col-md-3">
                <label for="tglsk" class="control-label">Tanggal Surat Keputusan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input disabled type="text" class="form-control" value="{{ $data->tgl_sk_gub }}" name="tglsk" id="tglsk" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-7">
                <label for="perusahaan" class="control-label">Perusahaan Pemegang Ijin</label>
                <div class="input-group">
                  <select disabled class="form-control" name="perusahaan" id="perusahaan" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button disabled id="btnperusahaan" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>
              
              <div class="form-group col-md-5">
                <label for="wilayah" class="control-label">Wilayah</label>
                <input type="text" class="form-control" value="{{ $data->perusahaan->wilayah->wilayah }}" id="wilayah" readonly="true">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="alamat" class="control-label">Alamat</label>
                <input type="text" class="form-control" value="{{ $data->perusahaan->alamat }}" id="alamat" readonly="true">
              </div>
            </div>
          </div>

          {{-- Masa Berlaku --}}
          <div class="box-header with-border">
            <h3 class="box-title">Masa Berlaku</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tglawal" class="control-label">Tanggal Awal</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="tglawal" value="{{ $data->tgl_sk_gub }}" readonly="true">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tglakhir" class="control-label">Tanggal Akhir</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="tglakhir" value="{{ $data->tgl_akhir }}" readonly="true">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          {{-- Identitas Kendaraan --}}
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Kendaraan</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nokendaraan" class="control-label">Nomor Kendaraan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="nokendaraan" id="nokendaraan" value="{{ $data->no_kendaraan }}" placeholder="Nomor Kendaraan" required>
                    <span class="input-group-btn">
                      <button  data-toggle="modal" data-target="#modal-nokendaraan" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tahunkendaraan" class="control-label">Tahun Kendaraan</label>
                  <input type="text" class="form-control" name="tahunkendaraan" value="{{ $data->tahun_kendaraan }}" id="tahunkendaraan" placeholder="Tahun Kendaraan" required>
                </div>
                <div class="form-group">
                  <label for="merkkendaraan" class="control-label">Model / Merk</label>
                  <select class="form-control" name="merkkendaraan" id="merkkendaraan" required style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label for="jeniskendaraan" class="control-label">Jenis Kendaraan</label>
                  <select class="form-control" name="jeniskendaraan" id="jeniskendaraan" required style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label class="control-label">Warna</label>
                  <div class="input-group">
                    <select class="form-control" name="warna" id="warna" required style="width: 100%;"></select>
                    <span class="input-group-btn">
                      <button  data-toggle="modal" data-target="#modal-warna" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="pemilik" class="control-label">Pemilik</label>
                  <input type="text" class="form-control" name="pemilik" value="{{ $data->pemilik }}" id="pemilik" placeholder="Pemilik Kendaraan" required>
                </div>
                <div class="form-group">
                  <label for="alamatkendaraan" class="control-label">Alamat</label>
                  <input type="text" class="form-control" value="{{ $data->alamat }}" name="alamatkendaraan" id="alamatkendaraan" placeholder="Alamat" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ditetaptgl" class="control-label">Ditetapkan Tanggal</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="ditetaptgl" id="ditetaptgl" value="{{ $data->tgl_ditetapkan }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nouji" class="control-label">Nomor Uji</label>
                  <input type="text" class="form-control" value="{{ $data->nomor_uji }}" name="nouji" id="nouji" placeholder="Nomor Uji" required>
                </div>
                <div class="form-group">
                  <label for="isisilinder" class="control-label">Isi Silinder</label>
                  <input type="text" class="form-control" value="{{ $data->isi_silinder }}" name="isisilinder" id="isisilinder" placeholder="Isi Silinder" required>
                </div>
                <div class="form-group">
                  <label for="jbi" class="control-label">JBI</label>
                  <div class="input-group">
                    <input type="text" class="form-control" value="{{ $data->jbi }}" name="jbi" id="jbi" placeholder="Jumlah Berat yang Diizinkan" required>
                    <span class="input-group-addon">Kg</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dayaorang" class="control-label">Daya Orang</label>
                  <div class="input-group">
                    <input type="text" class="form-control" value="{{ $data->daya_orang }}" name="dayaorang" id="dayaorang" placeholder="Jumlah Daya Orang" required>
                    <span class="input-group-addon">Or</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="dayabarang" class="control-label">Daya Barang</label>
                  <div class="input-group">
                    <input type="text" class="form-control" value="{{ $data->daya_barang }}" name="dayabarang" id="dayabarang" placeholder="Jumlah Daya Barang" required>
                    <span class="input-group-addon">Kg</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nolambung" class="control-label">Nomor Lambung</label>
                  <input disabled type="text" value="{{ $data->nolambung }}" class="form-control" name="nolambung" id="nolambung" placeholder="Nomor Lambung" value="" required>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="pull-right">
              <button id="btn-saveprint" type="submit" class="btn btn-success">Save & Print</button>
              <button id="btn-save" type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- modal jika status awal kendaraan pribadi --}}
  <div class="modal fade" id="modal-pribadi">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Data Perubahan Sifat</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-condensed" cellspacing="0" width="100%" id="table">
            <thead>
              <tr>
                <th style="width:60px;"></th>
                <th>No. Surat</th>
                <th>Perusahaan</th>
                <th>No. Surat Permohonan</th>
                <th>Tgl. Surat Permohonan</th>
                <th>No. Surat Kepala Dinas</th>
                <th>Pemilik Kendaraan</th>
                <th>Jenis</th>
                <th>Merk</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-nokendaraan">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Data Kendaraan SK : {{ $data->no_sk_gub }}</h4>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-condensed" cellspacing="0" width="100%" id="table-persk">
            <thead>
              <tr>
                <tr>
                  <th>No. Kendaraan</th>
                  <th>No. KP</th>
                  <th>Tgl. Perpanjangan</th>
                  <th>Status Awal</th>
                  <th></th>
                </tr>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-warna">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Tambah Data Warna Kendaraan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Warna Kendaraan</label>
            <input type="text" class="form-control" id="warnatambah" placeholder="Nama Warna Kendaraan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button id="btnwarnatambah" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-perusahaan" onSubmit="return tidakSubmit();">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" data-toggle="validator" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Data Perusahaan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Kategori Perusahaan</label>
              <select class="form-control" name="mkategoriperusahaan_id" id="katperusahaan" required style="width: 100%;"></select>
            </div>
            <div class="form-group">
              <label class="control-label">Nama Perusahaan</label>
              <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
            </div>
            <div class="form-group">
              <label class="control-label">Nama Pemimpin Perusahaan</label>
              <input type="text" class="form-control" name="pemimpin" placeholder="Nama Pemimpin Perusahaan" required>
            </div>
            <div class="form-group">
              <label class="control-label">Alamat Perusahaan</label>
              <input type="text" class="form-control" name="alamat" placeholder="Alamat Perusahaan" required>
            </div>
            <div class="form-group">
              <label class="control-label">Wilayah</label>
              <select class="form-control" name="mwilayah_id" id="wilayah" required style="width: 100%;"></select>
            </div>
            <div class="form-group">
              <label class="control-label">No. Badan Hukum</label>
              <input type="text" class="form-control" name="no_badan_hukum" placeholder="Nomor Badan Hukum Perusahaan" required>
            </div>
            <div class="form-group">
              <label class="control-label">No. Telepon</label>
              <input type="text" class="form-control" name="telp" placeholder="Nomor Telepon Perusahaan" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button id="btnperusahaantambah" type="button" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop

@section('js')
<script type="text/javascript">
  $( document ).ready(function() {
    var jangkutan = '{{ $angkutan }}';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var pribadi = false;
    var btnsubmit;

    $('#btn-saveprint').on('click', function () {
      btnsubmit = 1;
    });
    $('#btn-save').on('click', function () {
      btnsubmit = 2;
    });

    $('#form-utama').validator().on('submit', function (e) {
      var val = e.wich;      
      if (e.isDefaultPrevented() == false) {
        if (btnsubmit == 1) {
          e.preventDefault();
          $('#form-utama button').prop('disabled', true);
          savePrint();
        }
      }
    });

    function savePrint() {
      var form = $('#form-utama').serializeArray();
      var jadi = {};
      $.map(form, function(n, i){
          jadi[n['name']] = n['value'];
      });

      $.ajax({
        url: "{{ route('kp.'. $angkutan .'.api.update', ['id' => $data->kode]) }}",
        type: 'PUT',
        data: {
          _token: CSRF_TOKEN,
          form:jadi
        },
        dataType: 'JSON',
        success: function (data) {
          $('#form-utama button').prop('disabled', false);
          var urlprint = "{{ URL('kp/'. $angkutan .'/cetak') }}/";
          var win = window.open(urlprint + data.data, '_blank');
          win.focus();
        }
      });
    };

    function getNoUnik(perusahaan) {
      $.get("nolambung/"+ perusahaan, function(data){
          $('#nolambung').val(data);
      });
    };
    $('#tglsk').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      },
    });
    $('#ditetaptgl').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'YYYY-MM-DD'
      },
    });
    $("#sak").select2({
      placeholder: "Pilih Status Awal Kendaraan...",
      allowClear: false,
      ajax: {
          url: '{{ route("sak.select") }}',
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
    $("#warna").select2({
      placeholder: "Pilih Warna Kendaraan...",
      allowClear: false,
      ajax: {
          url: '{{ route("warna.select") }}',
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
    $("#perusahaan").select2({
      placeholder: "Pilih Perusahaan...",
      allowClear: false,
      ajax: {
          url: "{{ $angkutan == 'taksi' ? route('taksi.perusahaan.select') : route('perusahaan.select') }}",
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
    $("#jeniskendaraan").select2({
      placeholder: "Pilih Jenis Kendaraan...",
      allowClear: false,
      ajax: {
          url: '{{ route("jk.select") }}',
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
    $("#merkkendaraan").select2({
      placeholder: "Pilih Merk Kendaraan...",
      allowClear: false,
      ajax: {
          url: '{{ route("merk.select") }}',
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

    select2isi('#perusahaan', "{{ $data->mperusahaan_id }}", "{{ $data->perusahaan->nama_perusahaan }}");
    select2isi('#sak', "{{ $data->mstatusawalkendaraan_id }}", "{{ $data->statusawalkendaraan->status_awal }}");
    
    @if ($data->warna)
        select2isi('#warna', "{{ $data->warna }}", "{{ $data->mwarna->warna }}");
    @endif
    @if ($data->mjeniskendaraan_id)
        select2isi('#jeniskendaraan', "{{ $data->mjeniskendaraan_id }}", "{{ $data->jeniskendaraan->jenis }}");
    @endif
    @if ($data->mmerk_id)
        select2isi('#merkkendaraan', "{{ $data->mmerk_id }}", "{{ $data->merk->merk }}");
    @endif
    

    $('#perusahaan').on('select2:select', function (e) {
        id = $(this).val();
        $('#nolambung').attr('data-remote', id +'/v');
        getNoUnik(id);
        getPerusahaan(id);
    });

    function getPerusahaan(id) {
      $.get("{{$angkutan == 'taksi' ? url('/m/perusahaantaksi/select') : url('/m/perusahaan/select')}}/"+id, function(data){
          $('#alamat').val(data.alamat);
          $('#wilayah').val(data.wilayah.wilayah);
      });
    }

    $('#tglsk').on('apply.daterangepicker', function(ev, picker) {
      var tglawal = picker.startDate.format('YYYY-MM-DD');
      var split = tglawal.split('-');
      var tahunakhir = parseInt(split[0])+4;
      var tglakhir = tahunakhir + '-' + split[1] + '-' + split[2];
      $('#tglawal').val(tglawal);
      $('#tglakhir').val(tglakhir);
    });

    $('#sak').on('select2:select', function (e) {
      var id = e.params.data.id;
      if (id == 1) {
        $("#modal-pribadi").modal('show');
      }else{
        pribadi = false;
        $('#perusahaan').val(null).trigger('change');
        $('#alamat').val('');
        $('#wilayah').val('');
        $('#merkkendaraan').val(null).trigger('change');
        $('#jeniskendaraan').val(null).trigger('change');
        $('#pemilik').val('');
        $('#alamatkendaraan').val('');
        $('#nokendaraan').val('');
      }
    });

    $('#modal-pribadi').on('hidden.bs.modal', function (e) {
      if (pribadi == false) {
        $('#sak').val(null).trigger('change');
      }
    });

    var table = $('#table').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: '{!! route('perubahansifat.get') !!}',
      columns: [
        { data: null, defaultContent: '<button class="btn btn-success btn-sm" id="btnpilih">Pilih</button>', orderable: false, searchable: false},
        { data: 'no_surat_rekomendasi', name: 'no_surat_rekomendasi' },
        { data: 'perusahaan.nama_perusahaan', name: 'perusahaan.nama_perusahaan' },
        { data: 'no_surat_permohonan', name: 'no_surat_permohonan' },
        { data: 'tgl_surat_permohonan', name: 'tgl_surat_permohonan' },
        { data: 'nosuratpenyelenggaraan', name: 'nosuratpenyelenggaraan' },
        { data: 'pemilik', name: 'pemilik' },
        { data: 'jeniskendaraan.jenis', name: 'jeniskendaraan.jenis' },
        { data: 'merk.merk', name: 'merk.merk' },
      ],
      order: [[1, 'asc']]
    });
    
    var rawRoute = "{{ route('ask.dt.kpsk.kp', ['sk' => '']) }}";
    var skj = "{{ $data->no_sk_gub }}";
    var skjos = skj.replace(/\//g, "_");
    console.log(skjos);
    
    var table = $('#table-persk').DataTable({
      processing: true,
      serverSide: true,
      ajax: rawRoute + '/' + skjos,
      columns: [
        { data: 'no_kendaraan', name: 'no_kendaraan' },
        { data: 'no_kp', name: 'no_kp' },
        { data: 'tgl1', name: 'tgl1' },
        { data: 'statusawalkendaraan.status_awal', name: 'statusawalkendaraan.status_awal' },
        { data: 'pilih', name: 'pilih', orderable: false, searchable: false},
      ]
    });

    $('#table tbody').on('click', '#btnpilih', function () {
      var data = table.row($(this).parents('tr')).data();
      getPribadi(data.id);
      pribadi = true;
      $("#modal-pribadi").modal('hide');
    });

    function getPribadi(id) {
      $.get("{{url('/pribadi/select')}}/"+id, function(data){
        select2isi('#perusahaan', data.mperusahaan_id, data.perusahaan.nama_perusahaan);
        getPerusahaan(data.mperusahaan_id);
        getNoUnik(data.mperusahaan_id);
        $('#nolambung').attr('data-remote', data.mperusahaan_id +'/v');
        getPerusahaan(data.mperusahaan_id);
        $('#nokendaraan').val(data.no_kendaraan);
        select2isi('#merkkendaraan', data.merk.id, data.merk.merk);
        select2isi('#jeniskendaraan', data.jeniskendaraan.id, data.jeniskendaraan.jenis);
        $('#pemilik').val(data.pemilik);
        $('#tahunkendaraan').val(data.tahun_kendaraan.slice(0,4));
        $('#alamatkendaraan').val(data.alamat);
      });
    }

    function select2isi(el, id, text) {
      if ($(el).find("option[value='" + id + "']").length) {
        $(el).val(id).trigger('change');
      } else {
        var newOption = new Option(text, id, true, true);
        $(el).append(newOption).trigger('change');
      }
    }
    $('#btnwarnatambah').click(function(){
      var warna = $('#warnatambah').val();
      if (warna != '') {
        $.ajax({
          url: "{{ route('api.warna.store') }}",
          type: 'POST',
          data: {
            _token: CSRF_TOKEN,
            form:warna
          },
          dataType: 'JSON',
          success: function (data) {
            if (data.status == 'success') {
              $('#modal-warna').modal('hide');
              var dataselect = new Option(data.data, data.id, false, false);
              $("select[name=warna]").append(dataselect).trigger('change');
            }
          }
        });
      }
    });
    $('#modal-warna').on('hidden.bs.modal', function (e) {
      $('#warnatambah').val('');
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
    $("select[name=mwilayah_id]").select2({
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

    $('#btnperusahaan').click(function(){
      $('#modal-perusahaan').modal('show');
    });
    $('#modal-perusahaan').on('hidden.bs.modal', function (e) {
      $('#modal-perusahaan form')[0].reset();
    });
    $('#btnperusahaantambah').click(function(){
      var form = $('#modal-perusahaan form').serializeArray();
      var jadi = {};
      $.map(form, function(n, i){
          jadi[n['name']] = n['value'];
      });
      $.ajax({
        url: "{{ $angkutan == 'taksi' ? route('api.taksi.perusahaan.store') : route('api.perusahaan.store') }}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          form:jadi
        },
        dataType: 'JSON',
        success: function (data) {
          $('#' + data.modal).modal('hide');
          select2isi('#perusahaan', data.id, data.data);
          getNoUnik(data.id);
          getPerusahaan(data.id);
        }
      });
    });
  });
</script>
@stop