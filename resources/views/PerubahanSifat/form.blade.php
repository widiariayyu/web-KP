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
  <h1>Surat Rekomendasi Perubahan Sifat</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('perubahansifat')}}"><i class="fa fa-dashboard"></i> Perubahan Sifat</li></a>
    <li class="active">Surat Rekomendasi</li>
  </ol>
@stop

@section('content')
  @include('notif')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Surat & Perusahaan</h3>
        </div>
        <form id="form-utama" role="form" data-toggle="validator" action="{{route('perubahansifat.store')}}" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Nomor Surat Rekomendasi Perubahan Sifat</label>
                <input type="text" class="form-control" name="no_surat_rekomendasi" placeholder="Nomor Surat Rekomendasi Perubahan Sifat" required>
              </div>

              <div class="form-group col-md-5">
                <label class="control-label">Nama Usaha</label>
                <div class="input-group">
                  <select class="form-control" name="mperusahaan_id" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button id="btnperusahaan" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>

              <div class="form-group col-md-3">
                <label for="katusaha" class="control-label">Kategori Usaha</label>
                <input type="text" class="form-control" id="katusaha" readonly="true">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">No. Surat Permohonan</label>
                <input type="text" class="form-control" name="no_surat_permohonan" placeholder="Nomor Surat Permohonan" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Tanggal Surat Permohonan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control tglpilih" id="tglsuratpermohonan" required>
                </div>
              </div>
              <input type="hidden" value="{{date('Y-m-d')}}" name="tgl_surat_permohonan">
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">No. Surat Penyelenggaraan</label>
                <input type="text" class="form-control" name="nosuratpenyelenggaraan" placeholder="Nomor Surat Penyelenggaraan" required>
              </div>

              <div class="form-group col-md-3">
                <label class="control-label">Tanggal Surat Penyelenggaraan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control tglpilih" id="tglsuratpenyelenggaraan" required>
                </div>
              </div>
              <input type="hidden" value="{{date('Y-m-d')}}" name="tglsuratpenyelenggaraan">

              <div class="form-group col-md-5">
                <label class="control-label">Pasal Peraturan Mentri</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="pasalpermen" readonly="true">
                  <span class="input-group-addon">Nomor</span>
                  <input type="text" class="form-control" id="nopermen" readonly="true">
                </div>
              </div>
              <input type="hidden" name="msettingsuratpasal_id">
            </div>
          </div>

          {{-- Data Kendaraan --}}
          <div class="box-header with-border">
            <h3 class="box-title">Data Kendaraan</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-4">
                <label class="control-label">Tahun Kendaraan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control tglpilih" id="tahunkendaraan" placeholder="Tahun Kendaraan">
                </div>
              </div>
              <input type="hidden" value="{{date('Y-m-d')}}" name="tahun_kendaraan">

              <div class="form-group col-md-4">
                <label class="control-label">Nomor Faktur</label>
                <input type="text" class="form-control" name="no_faktur" placeholder="No Faktur Kendaraan" required>
              </div>

              <div class="form-group col-md-4">
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
              <div class="form-group col-md-6">
                <label class="control-label">Pemilik Kendaraan</label>
                <input type="text" class="form-control" name="pemilik" placeholder="Pemilik Kendaraan" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Nomor Kendaraan</label>
                <input type="text" class="form-control" name="no_kendaraan" placeholder="Nomor Kendaraan" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Nomor Rangka</label>
                <input type="text" class="form-control" name="no_rangka" placeholder="Nomor Rangka Kendaraan" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Nomor Mesin</label>
                <input type="text" class="form-control" name="no_mesin" placeholder="Nomor Mesin Kendaraan" required>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label class="control-label">Model / Merk</label>
                <div class="input-group">
                  <select class="form-control" name="mmerk_id" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button id="btnmerk" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Jenis Kendaraan</label>
                <div class="input-group">
                  <select class="form-control" name="mjeniskendaraan_id" required style="width: 100%;"></select>
                  <span class="input-group-btn">
                    <button id="btnjenis" type="button" class="btn btn-info btn-flat"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-9">
                <label class="control-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat Pemilik Kendaraan" required>
              </div>

              <div class="form-group col-md-3">
                <label class="control-label">Wilayah</label>
                <select class="form-control" name="wilayah_id" required style="width: 100%;"></select>
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

  <div class="modal fade" id="modal" onSubmit="return tidakSubmit();">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" data-toggle="validator" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 id="title-jenismerk" class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label id="label-jenismerk" class="control-label"></label>
              <input type="text" class="form-control" id="jenismerk" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button id="btnjenismerktambah" type="button" class="btn btn-primary">Save</button>
          </div>
        </form>
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
  function tidakSubmit() {
    return false;
  }
  $( document ).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var aksi;
    var btnsubmit;

    $("input[name=no_surat_rekomendasi]").on('keydown', function(e) { 
      var keyCode = e.keyCode || e.which; 
      if (keyCode == 9) {
        $("select[name=mperusahaan_id]").select2('open');
      } 
    });
    $("input[name=no_mesin]").on('keydown', function(e) { 
      var keyCode = e.keyCode || e.which; 
      if (keyCode == 9) {
        $("select[name=mmerk_id]").select2('open');
      } 
    });
    $("#btnmerk").on('keydown', function(e) { 
      var keyCode = e.keyCode || e.which; 
      if (keyCode == 9) {
        $("select[name=mjeniskendaraan_id]").select2('open');
      } 
    });
    $("input[name=alamat]").on('keydown', function(e) { 
      var keyCode = e.keyCode || e.which; 
      if (keyCode == 9) {
        $("select[name=wilayah_id]").select2('open');
      } 
    });
    
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
        url: "{{ route('perubahansifat.api.store') }}",
        type: 'POST',
        data: {
          _token: CSRF_TOKEN,
          form:jadi
        },
        dataType: 'JSON',
        success: function (data) {
          $('#form-utama button').prop('disabled', false);
          var urlprint = "{{ URL('perubahansifat/cetak') }}/";
          var win = window.open(urlprint + data.data, '_blank');
          $('#form-utama')[0].reset();
          
          win.focus();
        }
      });
    };

    $('#tglsuratpermohonan').daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: true,
      showDropdowns: true,
      locale: {
        format: 'DD-MM-YYYY'
      },
    });
    $('#tglsuratpermohonan').on('hide.daterangepicker', function(ev, picker) {
      $('input[name=tgl_surat_permohonan]').val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('#tglsuratpenyelenggaraan').daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: true,
      showDropdowns: true,
      locale: {
        format: 'DD-MM-YYYY'
      },
    });
    $('#tglsuratpenyelenggaraan').on('hide.daterangepicker', function(ev, picker) {
      $('input[name=tglsuratpenyelenggaraan]').val(picker.startDate.format('YYYY-MM-DD'));
    });

    $('#tahunkendaraan').daterangepicker({
      singleDatePicker: true,
      autoUpdateInput: true,
      showDropdowns: true,
      locale: {
        format: 'DD-MM-YYYY'
      },
    });
    $('#tahunkendaraan').on('hide.daterangepicker', function(ev, picker) {
      $('input[name=tahun_kendaraan]').val(picker.startDate.format('YYYY-MM-DD'));
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

    $('#tglfaktur').on('input', function() {
      if ($(this).val() == '') {
        $('input[name=tgl_faktur]').val(null);
      }
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
    $("select[name=mjeniskendaraan_id]").select2({
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

    $('select[name=mperusahaan_id]').on('select2:select', function (e) {
      var id = $(this).val();
      getPerusahaan(id);
    });

    function getPerusahaan(id) {
      $.get("{{url('/m/perusahaan/select')}}/"+id, function(data){
          $('#katusaha').val(data.katperusahaan.kategori_perusahaan);
          $('#pasalpermen').val(data.katperusahaan.pasal.pasal_permen);
          $('#nopermen').val(data.katperusahaan.pasal.no_permen);
          $('input[name=msettingsuratpasal_id]').val(data.katperusahaan.pasal.id);
      });
    }

//form Master
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
    $("select[name=wilayah_id]").select2({
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
    function tambahmaster(url, data) {
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'JSON',
        success: function (data) {
          $('#' + data.modal).modal('hide');
          var dataselect = new Option(data.data, data.id, false, false);
          $(data.select).append(dataselect).trigger('change');
          if (data.select == 'select[name=mperusahaan_id]') {
            getPerusahaan(data.id);
          }
        }
      });
    }

    $('#btnperusahaan').click(function(){
      $('#modal-perusahaan').modal('show');
    });
    $('#btnmerk').click(function(){
      aksi = "merk";
      $('#label-jenismerk').text('Nama Merk Kendaraan');
      $('#title-jenismerk').text('Tambah Data Merk Kendaraan');
      $('#modal').modal('show');
    });
    $('#btnjenis').click(function(){
      aksi = "jenis";
      $('#label-jenismerk').text('Nama Jenis Kendaraan');
      $('#title-jenismerk').text('Tambah Data Jenis Kendaraan');
      $('#modal').modal('show');
    });
    $('#modal').on('hidden.bs.modal', function (e) {
      $('#modal form')[0].reset();
      aksi = "";
    });
    $('#modal-perusahaan').on('hidden.bs.modal', function (e) {
      $('#modal-perusahaan form')[0].reset();
      aksi = "";
    });

    $('#btnjenismerktambah').click(function(){
      var url;
      var form = $('#jenismerk').val();
      if (aksi == 'jenis') {
        url = "{{ route('api.jk.store') }}";
      }else if (aksi == 'merk') {
        url = "{{ route('api.merk.store') }}";
      }
      var data = {
        _token: CSRF_TOKEN,
        form:form
      };
      tambahmaster(url, data);
    });

    $('#btnperusahaantambah').click(function(){
      var url = "{{ route('api.perusahaan.store') }}";
      var form = $('#modal-perusahaan form').serializeArray();
      var jadi = {};
      $.map(form, function(n, i){
          jadi[n['name']] = n['value'];
      });
      var data = {
        _token: CSRF_TOKEN,
        form:jadi
      };
      tambahmaster(url, data);
    });
  });
</script>
@stop
