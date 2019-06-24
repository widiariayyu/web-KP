@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
  <h1>Kartu Pengawasan <small>Taksi</small></h1>
  <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Kartu Pengawasan</li>
    <li class="active"> Taksi</li>
  </ol>
@stop

@section('content')
  @include('notif')
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Kartu Pengawasan (Taksi)</h3>
          <div class="box-tools">
            <a href="{{route('kp.taksi.create')}}" type="button" id="btntambah" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> Buat Kartu Pengawasan</a>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-striped" cellspacing="0" width="100%" id="table">
            <thead>
              <tr>
                <th>No. Kartu Pengawasan</th>
                <th>No. Kendaraan</th>
                <th>No. Uji</th>
                <th>Tahun</th>
                <th>Merk</th>
                <th>Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th style="width:120px;"></th>
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
	  var table = $('#table').DataTable({
	      processing: true,
	      serverSide: true,
        responsive: true,
	      ajax: '{{ route('kp.taksi.get') }}',
	      columns: [
          { data: 'no_kp', name: 'no_kp' },
          { data: 'no_kendaraan', name: 'no_kendaraan' },
          { data: 'nomor_uji', name: 'nomor_uji' },
          { data: 'tahun_kendaraan', name: 'tahun_kendaraan' },
          { data: 'merk', name: 'merk' },
          { data: 'nama_perusahaan', name: 'nama_perusahaan' },
          { data: 'alamat', name: 'alamat' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
	      ]
    });
    
    $('#table tbody').on('click', '#btn-hapus-kp', function () {
      var data = table.row($(this).parents('tr')).data();
      $.confirm({
          title: 'Konfirmasi!',
          content: '' +
          '<form action="" class="formName">' +
          '<div class="form-group">' +
          '<label>Input Sandi untuk Hapus</label>' +
          '<input type="password" class="name form-control" required />' +
          '</div>' +
          '</form>',
          buttons: {
              formSubmit: {
                  text: 'Hapus',
                  btnClass: 'btn-red',
                  action: function () {
                      var pwd = this.$content.find('.name').val();
                      if(!pwd){
                        $.alert('Input Sandi Untuk Menghapus KP');
                        return false;
                      } else {
                        if (pwd == 'dishubkp') {
                          deleteKP(data.kode)
                        } else {
                            $.alert('Sandi Salah');
                            return false;
                        }
                      }
                  }
              },
              batal: function () {
                  //close
              },
          },
          onContentReady: function () {
              // bind to events
              var jc = this;
              this.$content.find('form').on('submit', function (e) {
                  // if the user submits the form by pressing enter in the field.
                  e.preventDefault();
                  jc.$$formSubmit.trigger('click'); // reference the button and click it
              });
          }
      });
    });

    function deleteKP(noKP) {
      $.ajax({
          url: "{{ url('/kp/ask') }}/"+noKP,
          type: 'delete',
          dataType: "JSON",
          data: {_token: CSRF_TOKEN},
          success: function (response) {
            console.log(response);
            table.ajax.reload();
          },
          error: function(xhr) {
            console.log(xhr.responseText); 
          }
      });
    }
  });
</script>
@stop
