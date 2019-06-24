<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\TaksiPerusahaan;
use Illuminate\Validation\Rule;
use Validator;

class TaksiPerusahaanController extends Controller
{
  public function index()
  {
      return view('Master Data.Perusahaan.Taksi');
  }

  public function getdata()
  {
      $datas = TaksiPerusahaan::with('katperusahaan', 'wilayah')->get();

      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
      return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
      })
      ->make(true);
  }

  public function validasi(Request $r)
  {
      return response()->json('gakboleh');
  }

  public function store(Request $r)
  {
    try {
      $data = TaksiPerusahaan::create([
        'id' => TaksiPerusahaan::noUnik(),
        'mkategoriperusahaan_id' => $r->katperusahaan, 
        'nama_perusahaan' => $r->nama, 
        'pemimpin' => $r->pemimpin, 
        'alamat' => $r->alamat, 
        'mwilayah_id' => $r->wilayah, 
        'no_badan_hukum' => $r->badanhukum,
        'telp' => $r->telp
      ]);
    } catch (\Exception $e) {
      return redirect()->action('TaksiPerusahaanController@index')->with('alert-danger','Data Perusahaan Taksi Gagal Ditambah.');
    }
    return redirect()->action('TaksiPerusahaanController@index')->with('alert-success','Data Perusahaan Taksi '.$data->nama_perusahaan.' Berhasil Ditambah.');
  }

  public function update(Request $r, $id)
  {
    try {
      $data = TaksiPerusahaan::find($id);
      $data->update([
        'mkategoriperusahaan_id' => $r->katperusahaan, 
        'nama_perusahaan' => $r->nama, 
        'pemimpin' => $r->pemimpin, 
        'alamat' => $r->alamat, 
        'mwilayah_id' => $r->wilayah, 
        'no_badan_hukum' => $r->badanhukum,
        'telp' => $r->telp
      ]);
    } catch (\Exception $e) {
      return redirect()->action('TaksiPerusahaanController@index')->with('alert-success','Data Perusahaan Taksi Gagal Diubah.');
    }
    return redirect()->action('TaksiPerusahaanController@index')->with('alert-success','Data Perusahaan Taksi '.$data->nama_perusahaan.' Berhasil Diubah.');
  }

  public function seldata(Request $r)
  {
      $term = trim($r->q);
      if (empty($term)) {
          $tags = TaksiPerusahaan::all();
      }else {
          $tags = TaksiPerusahaan::where('nama_perusahaan', 'LIKE', '%'. $term .'%')->get();
      }
      $formatted_tags = [];
      foreach ($tags as $tag) {
          $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_perusahaan];
      }
      return response()->json($formatted_tags);
  }

  public function selper($id)
  {
      $perusahaan = TaksiPerusahaan::with('katperusahaan.pasal', 'wilayah')->where('id', $id)->first();
      return response()->json($perusahaan);
  }

  public function apistore(Request $request)
  {
    try {
      $r = array_add($request['form'], 'id', TaksiPerusahaan::noUnik());
      $data = TaksiPerusahaan::create($r);
      $response = array(
        'status' => 'success',
        'modal' => 'modal-perusahaan',
        'select' => 'select[name=mperusahaan_id]',
        'id' => $data->id,
        'data' => $data->nama_perusahaan,
        'msg' => 'Berhasil Menambah Data Perusahaan Taksi '. $data->nama_perusahaan .' .',
      );
    } catch (Exception $e) {
      $response = array(
        'status' => 'danger',
        'modal' => 'modal-perusahaan',
        'select' => 'select[name=mperusahaan_id]',
        'id' => '',
        'data' => '',
        'msg' => 'Gagal Menambah Data Perusahaan Taksi '. $request['form']['nama_perusahaan'] .' .',
      );
    }
    return response()->json($response);
  }
}
