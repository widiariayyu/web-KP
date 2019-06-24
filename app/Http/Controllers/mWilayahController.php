<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mwilayah;
use Illuminate\Validation\Rule;
use Validator;

class mWilayahController extends Controller
{
    public function index()
    {
    	return view('Master Data.Wilayah');
    }

    public function getdata()
    {
    	$datas = Mwilayah::all();
        return Datatables::of($datas)
        ->addColumn('action', function ($data) {
            return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }

    public function validasi(Request $r)
    {
        // if (!empty($wilayah)) {
        //     $el = array('id' => $id, 'wilayah' => $wilayah);
        //     $validatedData = Validator::make($el, [
        //         'wilayah' => [Rule::unique('mwilayahs')->ignore($id)],
        //     ]);
        //     if ($validatedData->passes()) {
        //         return response()->json('boleh');
        //     }
        // }
        return response()->json('gakboleh');
    }

    public function store(Request $r)
    {
        $data = Mwilayah::create(['wilayah' => $r->wilayah, 'kota' => $r->kota]);
        return redirect()->action('mWilayahController@index')->with('alert-success','Data Wilayah '.$data->wilayah.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Mwilayah::find($id);
        $data->update(['wilayah' => $r->wilayah, 'kota' => $r->kota]);
        return redirect()->action('mWilayahController@index')->with('alert-success','Data Wilayah '.$data->wilayah.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mwilayah::all();
        }else {
            $tags = Mwilayah::where('wilayah', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->wilayah];
        }
        return response()->json($formatted_tags);
    }
}
