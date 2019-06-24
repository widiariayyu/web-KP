@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('css')
  <style>
    .tglpilih{
      background-color: #ffffff !important;
      cursor: pointer;
    }
  </style>
@endsection

@section('content_header')
  <h1>Peremajaan Kendaraan Sewa Khusus</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Peremajaan</li>
    <li class="active">Tambah</li>
  </ol>
@stop

@section('content')
  @include('notif')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form Peremajaan</h3>
        </div>
        <form id="form-utama" role="form" data-toggle="validator" action="{{route('peremajaan.ask.store')}}" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">No. Peremajaan</label>
                <input type="text" class="form-control" name="no_peremajaan" placeholder="Nomor Surat Peremajaan" required>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">No. Surat Permohonan</label>
                <input type="text" class="form-control" name="no_surat_permohonan" placeholder="Nomor Surat Permohonan" required>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Tanggal Surat Permohonan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input readonly type="text" class="form-control tglpilih" id="tglsuratpermohonan" required>
                </div>
              </div>
              <input type="hidden" value="{{date('Y-m-d')}}" name="tgl_surat_permohonan">
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Nama Perusahaan</label>
                <div class="input-group">
                  <select class="form-control" name="mperusahaan_id" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button id="btnperusahaan" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">No. Kartu Pengawasan</label>
                <div class="input-group">
                  <input id="no_kp" readonly type="text" class="form-control" placeholder="Nomor Kartu Pengawasan" required>
                  <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#modal-kp" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
                <input type="hidden" name="nolambung">
                <input type="hidden" name="kode_kp">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">No. Kendaraan</label>
                <input id="no_kendaraan" readonly type="text" class="form-control" placeholder="Nomor Kendaraan">
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">No. Uji Kendaraan</label>
                <input id="nomor_uji" readonly type="text" class="form-control" placeholder="Nomor Uji Kendaraan">
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Tahun Kendaraan</label>
                <input id="tahun_kendaraan" readonly type="text" class="form-control" placeholder="Tahun Kendaraan">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Merk</label>
                <input id="merk" readonly type="text" class="form-control" placeholder="Nomor Kendaraan">
              </div>

              <div class="form-group col-md-8">
                <label class="control-label">Alamat Perusahaan</label>
                <input id="alamat" readonly type="text" class="form-control" placeholder="Alamat Perusahaan">
              </div>
            </div>
          </div>

          <div class="box-header with-border">
            <h3 class="box-title">Digantikan dengan Kendaraan :</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Nomor Faktur</label>
                <input type="text" class="form-control" name="no_faktur" placeholder="No Faktur Kendaraan" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Tanggal Faktur</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control tglpilih" placeholder="Tanggal Faktur Kendaraan" id="tglfaktur">
                </div>
              </div>
              <input type="hidden" name="tgl_faktur">
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Nomor Kendaraan</label>
                <input type="text" class="form-control" name="no_kendaraan" placeholder="Nomor Kendaraan" required>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Tahun Kendaraan</label>
                <input type="text" class="form-control" name="tahun_kendaraan" placeholder="Tahun Kendaraan" required>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Model / Merk</label>
                <div class="input-group">
                  <select class="form-control" name="mmerk_id" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button data-toggle="modal" data-target="#modal-merk" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Nomor Mesin</label>
                <input type="text" class="form-control" name="no_mesin" placeholder="Nomor Mesin Kendaraan" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Nomor Rangka</label>
                <input type="text" class="form-control" name="no_rangka" placeholder="Nomor Rangka Kendaraan" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-5">
                <label class="control-label">Pemilik Kendaraan</label>
                <input type="text" class="form-control" name="pemilik" placeholder="Pemilik Kendaraan" required>
              </div>

              <div class="form-group col-md-7">
                <label class="control-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat Pemilik Kendaraan" required>
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

  <div class="modal fade" id="modal-merk">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Tambah Data Merk Kendaraan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">Merk Kendaraan</label>
            <input type="text" class="form-control" id="merktambah" placeholder="Nama Merk Kendaraan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button id="btnmerktambah" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  {{-- pilih kp --}}
  <div class="modal fade" id="modal-kp">
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
                <th>No. Kartu Pengawasan</th>
                <th>No. Kendaraan</th>
                <th>No. Uji</th>
                <th>Tahun</th>
                <th>Merk</th>
                <th>Perusahaan</th>
                <th>Alamat Perusahaan</th>
              </tr>
            </thead>
          </table>
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
        url: "{{ route('peremajaan.ask.api.store') }}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          form:jadi
        },
        dataType: 'JSON',
        success: function (data) {
          $('#form-utama button').prop('disabled', false);
          var urlprint = "{{ URL('peremajaan/ask/cetak') }}/";
          var win = window.open(urlprint + data.data, '_blank');
          $('#form-utama')[0].reset();
          $('select[name=mperusahaan_id]').val(null).trigger('change');
          $('select[name=mmerk_id]').val(null).trigger('change');
          win.focus();
        }
      });
    };

    $('#tglsuratpermohonan').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'DD-MM-YYYY'
      },
    });
    $('#tglsuratpermohonan').on('apply.daterangepicker', function(ev, picker) {
      $('input[name=tgl_surat_permohonan]').val(picker.startDate.format('YYYY-MM-DD'));
    });
    $('#tglfaktur').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      autoUpdateInput: false,
      locale: {
        format: 'DD-MM-YYYY'
      },
    });
    $('#tglfaktur').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY'));
      $('input[name=tgl_faktur]').val(picker.startDate.format('YYYY-MM-DD'));
    });
    $("select[name=mperusahaan_id]").select2({
      placeholder: "Pilih Perusahaan...",
      allowClear: false,
      ajax: {
          url: '{{ route("perusahaan.select") }}',
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
    $("select[name=mmerk_id]").select2({
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

    var table = $('#table').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: '{!! route('peremajaan.ask.getkp') !!}',
      columns: [
        { data: null, defaultContent: '<button class="btn btn-success btn-sm" id="btnpilih">Pilih</button>', orderable: false, searchable: false},
        { data: 'no_kp', name: 'no_kp' },
        { data: 'no_kendaraan', name: 'no_kendaraan' },
        { data: 'nomor_uji', name: 'nomor_uji' },
        { data: 'tahun_kendaraan', name: 'tahun_kendaraan' },
        { data: 'merk', name: 'merk' },
        { data: 'nama_perusahaan', name: 'nama_perusahaan' },
        { data: 'alamat', name: 'alamat' }
      ],
      order: [[1, 'asc']]
    });

    $('#table tbody').on('click', '#btnpilih', function () {
      var data = table.row($(this).parents('tr')).data();
      $('input[name=nolambung]').val(data.nolambung);
      $('input[name=kode_kp]').val(data.kode);
      $('#no_kp').val(data.no_kp);
      $('#no_kendaraan').val(data.no_kendaraan);
      $('#nomor_uji').val(data.nomor_uji);
      $('#tahun_kendaraan').val(data.tahun_kendaraan);
      $('#alamat').val(data.alamat);
      $('#merk').val(data.merk);
      $("#modal-kp").modal('hide');
    });

    $('#btnmerktambah').click(function(){
      var merk = $('#merktambah').val();
      if (merk != '') {
        $.ajax({
          url: "{{ route('api.merk.store') }}",
          type: 'POST',
          data: {
            _token: CSRF_TOKEN,
            form:merk
          },
          dataType: 'JSON',
          success: function (data) {
            if (data.status == 'success') {
              $('#modal-merk').modal('hide');
              var dataselect = new Option(data.data, data.id, false, false);
              $("select[name=mmerk_id]").append(dataselect).trigger('change');
            }
          }
        });
      }
    });
    $('#modal-merk').on('hidden.bs.modal', function (e) {
      $('#merktambah').val('');
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
        url: "{{ route('api.perusahaan.store') }}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          form:jadi
        },
        dataType: 'JSON',
        success: function (data) {
          $('#' + data.modal).modal('hide');
          var dataselect = new Option(data.data, data.id, false, false);
          $(data.select).append(dataselect).trigger('change');
          // $.get("{{url('/m/perusahaan/select')}}/"+data.id, function(data){
          //     $('#alamat').val(data.alamat);
          //     $('#wilayah').val(data.wilayah.wilayah);
          // });
        }
      });
    });
  });
</script>
@stop
