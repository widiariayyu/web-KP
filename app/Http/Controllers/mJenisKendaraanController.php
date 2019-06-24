<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mjeniskendaraan;
use Illuminate\Validation\Rule;
use Validator;

class mJenisKendaraanController extends Controller
{
    public function index()
    {
    	return view('Master Data.JenisKendaraan');
    }

    public function getdata()
    {
    	$datas = Mjeniskendaraan::all();
      return Datatables::of($datas)
      ->addColumn('action', function ($data) {
          return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
      })
      ->make(true);
    }

    public function validasi(Request $r)
    {
        // if (!empty($jeniskendaraan)) {
        //     $el = array('id' => $id, 'jeniskendaraan' => $jeniskendaraan);
        //     $validatedData = Validator::make($el, [
        //         'jeniskendaraan' => [Rule::unique('mjeniskendaraans')->ignore($id)],
        //     ]);
        //     if ($validatedData->passes()) {
        //         return response()->json('boleh');
        //     }
        // }
        return response()->json('gakboleh');
    }

    public function store(Request $r)
    {
        $data = Mjeniskendaraan::create(['jenis' => $r->jenis]);
        return redirect()->action('mJenisKendaraanController@index')->with('alert-success','Data Jenis Kendaraan '.$data->jenis.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Mjeniskendaraan::find($id);
        $data->update(['jenis' => $r->jenis]);
        return redirect()->action('mJenisKendaraanController@index')->with('alert-success','Data Jenis Kendaraan '.$data->jenis.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mjeniskendaraan::all();
        }else {
            $tags = Mjeniskendaraan::where('jenis', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->jenis];
        }
        return response()->json($formatted_tags);
    }

    public function apistore(Request $request)
    {
      try {
        $data = Mjeniskendaraan::create(['jenis' => $request['form']]);
        $response = array(
          'status' => 'success',
          'modal' => 'modal',
          'select' => 'select[name=mjeniskendaraan_id]',
          'id' => $data->id,
          'data' => $data->jenis,
          'msg' => 'Berhasil Menambah Data Jenis Kendaraan '. $data->jenis .' .',
        );
      } catch (\Exception $e) {
        $response = array(
          'status' => 'danger',
          'modal' => 'modal',
          'select' => 'select[name=mjeniskendaraan_id]',
          'id' => '',
          'data' => '',
          'msg' => 'Gagal Menambah Data Jenis Kendaraan '. $request['form'] .' .',
        );
      }
      return response()->json($response);
    }
}
