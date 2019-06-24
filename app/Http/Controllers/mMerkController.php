<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mmerk;
use Illuminate\Validation\Rule;
use Validator;

class mMerkController extends Controller
{
    public function index()
    {
    	return view('Master Data.Merk');
    }

    public function getdata()
    {
    	$datas = Mmerk::all();
        return Datatables::of($datas)
        ->addColumn('action', function ($data) {
            return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }

    public function validasi(Request $r)
    {
        $el = array('merk' => $r->merk);
        $validatedData = Validator::make($el, [
            'merk' => [Rule::unique('mmerks')],
        ]);
        if ($validatedData->passes()) {
            return response()->json(['message' => 'Pas MAntap'], 200);
        }
        return response()->json(['message' => 'Merk Sudah Ada'], 300);
    }

    public function store(Request $r)
    {
        $data = Mmerk::create(['merk' => $r->merk]);
        return redirect()->action('mMerkController@index')->with('alert-success','Data Merk '.$data->merk.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Mmerk::find($id);
        $data->update(['merk' => $r->merk]);
        return redirect()->action('mMerkController@index')->with('alert-success','Data Merk '.$data->merk.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mmerk::all();
        }else {
            $tags = Mmerk::where('merk', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->merk];
        }
        return response()->json($formatted_tags);
    }

    public function apistore(Request $request)
    {
      try {
        $data = Mmerk::create(['merk' => $request['form']]);
        $response = array(
          'status' => 'success',
          'modal' => 'modal',
          'select' => 'select[name=mmerk_id]',
          'id' => $data->id,
          'data' => $data->merk,
          'msg' => 'Berhasil Menambah Data Merk Kendaraan '. $data->merk .' .',
        );
      } catch (\Exception $e) {
        $response = array(
          'status' => 'danger',
          'modal' => 'modal',
          'select' => 'select[name=mmerk_id]',
          'id' => '',
          'data' => '',
          'msg' => 'Gagal Menambah Data Merk Kendaraan '. $request['form'] .' .',
        );
      }
      return response()->json($response);
    }
}
