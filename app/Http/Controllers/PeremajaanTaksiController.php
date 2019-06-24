<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeremajaanTaksi;
use App\KPTaksi;
use App\Msetting;
use Datatables;
use Fungsi;
use Auth;
use DB;
use PDF;

class PeremajaanTaksiController extends Controller
{
  public function index()
  {
    return view('peremajaan.taksi.index');
  }

  public function getdata()
  {
    $datas = PeremajaanTaksi::index()->get();
      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
          return '<a href="taksi/edit/'.$data->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a> <a href="taksi/cetak/'.$data->id.'" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i></a>';
      })
      ->make(true);
  }

  public function getkp()
  {
    $datas = KPTaksi::index()->get();
    return Datatables::of($datas)
    ->make(true);
  }

  public function create()
  {
    return view('peremajaan.taksi.form');
  }

  public function store(Request $request)
  {
    try {
      $kp = KPTaksi::index()->where('kode', $request->input('kode_kp'))->first();
      $request->request->add([
        'user_id' => Auth::id(),
        'no_kendaraan_lama' => $kp->no_kendaraan,
        'tahun_kendaraan_lama' => $kp->tahun_kendaraan,
        'no_uji_kendaraan_lama' => $kp->nomor_uji,
        'mmerk_id_lama' => $kp->merkid,
        'jenis_angkutan' => $kp->mjenisangkutan_id,
        'no_kp' => $kp->no_kp,
        'tgl_peremajaan' => date('Y-m-d')
      ]);
      $peremajaan = PeremajaanTaksi::create($request->all());
    } catch (\Exception $e) {
      return redirect()->action('PeremajaanTaksiController@index')->with('alert-danger','Peremajaan Gagal Dibuat.');
    }
    return redirect()->action('PeremajaanTaksiController@index')->with('alert-success','Peremajaan '.$peremajaan->no_peremajaan.' Berhasil Dibuat.');
  }

  public function apiStore(Request $request)
  {
    try {
      $kp = KPTaksi::index()->where('kode', $request['form']['kode_kp'])->first();
      $kpinput = array(
        'user_id' => Auth::id(),
        'no_kendaraan_lama' => $kp->no_kendaraan,
        'tahun_kendaraan_lama' => $kp->tahun_kendaraan,
        'no_uji_kendaraan_lama' => $kp->nomor_uji,
        'mmerk_id_lama' => $kp->merkid,
        'jenis_angkutan' => $kp->mjenisangkutan_id,
        'no_kp' => $kp->no_kp,
        'tgl_peremajaan' => date('Y-m-d')
      );
      $r = array_merge($request['form'], $kpinput);
      $peremajaan = PeremajaanTaksi::create($r);
      return response()->json(['msg' => 'Peremajaan Berhasil Dibuat.', 'data' => $peremajaan->id], 200);
    } catch (\Exception $e) {
      return response()->json(['msg' => 'Peremajaan Gagal Dibuat.'], 400);
    }
  }

  public function edit($id)
  {
    $data = PeremajaanTaksi::find($id);
    return view('peremajaan.taksi.form-edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    try {
      $peremajaan = PeremajaanTaksi::find($id);
      $kp = KPTaksi::index()->where('kode', $request->kode_kp)->first();
      $kpinput = array(
        'user_id' => Auth::id(),
        'no_kendaraan_lama' => $kp->no_kendaraan,
        'tahun_kendaraan_lama' => $kp->tahun_kendaraan,
        'no_uji_kendaraan_lama' => $kp->nomor_uji,
        'mmerk_id_lama' => $kp->merkid,
        'jenis_angkutan' => $kp->mjenisangkutan_id,
        'no_kp' => $kp->no_kp,
        'tgl_peremajaan' => date('Y-m-d')
      );
      $r = array_merge($request->all(), $kpinput);
      $peremajaan->update($r);
      return redirect()->action('PeremajaanTaksiController@index')->with('alert-success','Peremajaan Berhasil Diubah.');
    } catch (\Exception $e) {
      return redirect()->action('PeremajaanTaksiController@index')->with('alert-danger','Peremajaan Gagal Diubah.');
    }
  }

  public function apiUpdate(Request $request, $id)
  {
    try {
      $peremajaan = PeremajaanTaksi::find($id);
      $kp = KPTaksi::index()->where('kode', $request['form']['kode_kp'])->first();
      $kpinput = array(
        'user_id' => Auth::id(),
        'no_kendaraan_lama' => $kp->no_kendaraan,
        'tahun_kendaraan_lama' => $kp->tahun_kendaraan,
        'no_uji_kendaraan_lama' => $kp->nomor_uji,
        'mmerk_id_lama' => $kp->merkid,
        'jenis_angkutan' => $kp->mjenisangkutan_id,
        'no_kp' => $kp->no_kp,
        'tgl_peremajaan' => date('Y-m-d')
      );
      $r = array_merge($request['form'], $kpinput);
      $peremajaan->update($r);
      return response()->json(['msg' => 'Peremajaan Berhasil Diubah.', 'data' => $peremajaan->id], 200);
    } catch (\Exception $e) {
      return response()->json(['msg' => 'Peremajaan Gagal Diubah.'], 400);
    }
  }

  public function cetak($id)
  {
    $data = PeremajaanTaksi::Index()->where('peremajaantaksi.id', $id)->first();
    $setting = Msetting::first();
    $pdf = PDF::loadView('peremajaan.taksi.cetak', compact('data', 'setting'));
    return $pdf->stream('Peremajaan:'.$data->no_peremajaan.'.pdf');
  }
}
