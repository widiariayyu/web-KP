<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mwarna;
use Illuminate\Validation\Rule;
use Validator;

class mWarnaController extends Controller
{
  public function index()
  {
    return view('Master Data.Warna');
  }

  public function getdata()
  {
    $datas = Mwarna::all();
      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
          return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
      })
      ->make(true);
  }

  public function validasi(Request $r)
  {
      // if (!empty($warna)) {
      //     $el = array('id' => $id, 'warna' => $warna);
      //     $validatedData = Validator::make($el, [
      //         'warna' => [Rule::unique('mwarnas')->ignore($id)],
      //     ]);
      //     if ($validatedData->passes()) {
      //         return response()->json('boleh');
      //     }
      // }
      return response()->json('gakboleh');
  }

  public function store(Request $r)
  {
      $data = Mwarna::create(['warna' => $r->warna]);
      return redirect()->action('mWarnaController@index')->with('alert-success','Data Warna '.$data->warna.' Berhasil Ditambah.');
  }

  public function update(Request $r, $id)
  {
      $data = Mwarna::find($id);
      $data->update(['warna' => $r->warna]);
      return redirect()->action('mWarnaController@index')->with('alert-success','Data Warna '.$data->warna.' Berhasil Diubah.');
  }

  public function seldata(Request $r)
  {
      $term = trim($r->q);
      if (empty($term)) {
          $tags = Mwarna::all();
      }else {
          $tags = Mwarna::where('warna', 'LIKE', '%'. $term .'%')->get();
      }
      $formatted_tags = [];
      foreach ($tags as $tag) {
          $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->warna];
      }
      return response()->json($formatted_tags);
  }

  public function apistore(Request $request)
  {
    try {
      $data = Mwarna::create(['warna' => $request['form']]);
      $response = array(
        'status' => 'success',
        'modal' => 'modal',
        'select' => 'select[name=warna]',
        'id' => $data->id,
        'data' => $data->warna,
        'msg' => 'Berhasil Menambah Data Warna Kendaraan '. $data->warna .' .',
      );
    } catch (\Exception $e) {
      $response = array(
        'status' => 'danger',
        'modal' => 'modal',
        'select' => 'select[name=warna]',
        'id' => '',
        'data' => '',
        'msg' => 'Gagal Menambah Data Warna Kendaraan '. $request['form'] .' .',
      );
    }
    return response()->json($response);
  }
}
