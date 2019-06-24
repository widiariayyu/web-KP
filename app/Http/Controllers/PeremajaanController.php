<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tperemajaan;
use App\Txkp;
use App\Msetting;
use Datatables;
use Fungsi;
use Auth;
use DB;
use PDF;

class PeremajaanController extends Controller
{
  public function index()
  {
    return view('peremajaan.ask.index');
  }

  public function getdata()
  {
    $datas = Tperemajaan::index()->get();
      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
          return '<a href="ask/edit/'.$data->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a> <a href="ask/cetak/'.$data->id.'" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i></a>';
      })
      ->make(true);
  }

  public function getkp()
  {
    $datas = Txkp::index()->get();
    return Datatables::of($datas)
    ->make(true);
  }

  public function create()
  {
    return view('peremajaan.ask.form');
  }

  public function store(Request $request)
  {
    try {
      $kp = Txkp::index()->where('kode', $request->input('kode_kp'))->first();
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
      $peremajaan = Tperemajaan::create($request->all());
    } catch (\Exception $e) {
      return redirect()->action('PeremajaanController@index')->with('alert-danger','Peremajaan Gagal Dibuat.');
    }
    return redirect()->action('PeremajaanController@index')->with('alert-success','Peremajaan '.$peremajaan->no_peremajaan.' Berhasil Dibuat.');
  }

  public function apiStore(Request $request)
  {
    try {
      $kp = Txkp::index()->where('kode', $request['form']['kode_kp'])->first();
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
      $peremajaan = Tperemajaan::create($r);
      return response()->json(['msg' => 'Peremajaan Berhasil Dibuat.', 'data' => $peremajaan->id], 200);
    } catch (\Exception $e) {
      return response()->json(['msg' => 'Peremajaan Gagal Dibuat.'], 400);
    }
  }

  public function edit($id)
  {
    $data = Tperemajaan::find($id);
    return view('peremajaan.ask.form-edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    try {
      $peremajaan = Tperemajaan::find($id);
      $kp = Txkp::index()->where('kode', $request->kode_kp)->first();
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
      return redirect()->action('PeremajaanController@index')->with('alert-success','Peremajaan Berhasil Diubah.');
    } catch (\Exception $e) {
      return redirect()->action('PeremajaanController@index')->with('alert-danger','Peremajaan Gagal Diubah.');
    }
  }

  public function apiUpdate(Request $request, $id)
  {
    try {
      $peremajaan = Tperemajaan::find($id);
      $kp = Txkp::index()->where('kode', $request['form']['kode_kp'])->first();
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
    $data = Tperemajaan::Index()->where('tperemajaan.id', $id)->first();
    $setting = Msetting::first();
    $pdf = PDF::loadView('peremajaan.ask.cetak', compact('data', 'setting'));
    return $pdf->stream('Peremajaan:'.$data->no_peremajaan.'.pdf');
  }
}
