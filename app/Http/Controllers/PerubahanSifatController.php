<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tperubahansifat;
use Datatables;
use Auth;
use PDF;
use App\Msetting;

class PerubahanSifatController extends Controller
{
	public function index()
	{
		return view('PerubahanSifat.index');
	}

	public function getdata()
  {
  	$datas = Tperubahansifat::with('user','perusahaan', 'merk', 'jeniskendaraan', 'suratpasal')->get();
      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
          return '<a href="perubahansifat/'.$data->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a> <a href="perubahansifat/cetak/'.$data->id.'" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i></a>';
      })
      ->make(true);
  }

  public function seldata($id)
  {
    $datas = Tperubahansifat::where('id', $id)->with('user','perusahaan', 'merk', 'jeniskendaraan', 'suratpasal')->first();
    return response()->json($datas);
  }

  public function create()
	{
		return view('PerubahanSifat.form');
  }
  
  public function apiStore(Request $request)
  {
    try {
      $r = array_add($request['form'], 'user_id', Auth::id());
			$data = Tperubahansifat::create($r);
      return response()->json(['msg' => 'Berhasil Menambah Data', 'data' => $data->id], 200);
		} catch (\Exception $e) {
			return response()->json(['msg' => 'Gagal Menambah Data'], 400);
		}
  }

	public function store(Request $request)
  {
		try {
			$request->request->add(['user_id' => Auth::id()]);
			$data = Tperubahansifat::create($request->all());
		} catch (\Exception $e) {
			return redirect()->action('PerubahanSifatController@index')->with('alert-danger','Surat Rekomendasi Perubahan Sifat '.$request->no_surat_rekomendasi.' Gagal Ditambah.');
		}
    return redirect()->action('PerubahanSifatController@index')->with('alert-success','Surat Rekomendasi Perubahan Sifat '.$data->no_surat_rekomendasi.' Berhasil Ditambah.');
  }

  public function edit($id)
	{
    $data = Tperubahansifat::find($id);
		return view('PerubahanSifat.form-edit', compact('data'));
  }

  public function apiUpdate(Request $request, $id)
  {
    $data = Tperubahansifat::find($id);
    try {
      $r = array_add($request['form'], 'user_id', Auth::id());
			$data->update($r);
      return response()->json(['msg' => 'Berhasil Merubah Data', 'data' => $data->id], 200);
		} catch (\Exception $e) {
			return response()->json(['msg' => 'Gagal Merubah Data'], 400);
		}
  }

  public function update(Request $request, $id)
  {
    $data = Tperubahansifat::find($id);
		try {
			$request->request->add(['user_id' => Auth::id()]);
			$data->update($request->all());
		} catch (Exception $e) {
      dd($e);
			return redirect()->action('PerubahanSifatController@index')->with('alert-danger','Surat Rekomendasi Perubahan Sifat '.$request->no_surat_rekomendasi.' Gagal Diubah.');
		}
    return redirect()->action('PerubahanSifatController@index')->with('alert-success','Surat Rekomendasi Perubahan Sifat '.$data->no_surat_rekomendasi.' Berhasil Diubah.');
  }

  public function cetak($id)
  {
    $data = Tperubahansifat::find($id);
    $perusahaan = $data->perusahaan;
    $katperusahaan = $perusahaan->katperusahaan;
    $wilperusahaan = $perusahaan->wilayah;
    $merk = $data->merk;
    $jeniskendaraan = $data->jeniskendaraan;
    $suratpasal = $data->suratpasal;
    $data->wilayahPemilik;
    $setting = Msetting::first();

    $pdf = PDF::loadView('PerubahanSifat.cetak-'.$katperusahaan->kategori_perusahaan, compact('data', 'perusahaan', 'katperusahaan', 'wilperusahaan', 'merk', 'jeniskendaraan', 'suratpasal', 'setting'));
    return $pdf->stream($data->no_surat_permohonan.'.pdf');
  }
}
