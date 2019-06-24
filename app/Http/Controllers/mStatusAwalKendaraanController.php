<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mstatusawalkendaraan;
use Illuminate\Validation\Rule;
use Validator;

class mStatusAwalKendaraanController extends Controller
{
    public function index()
    {
    	return view('Master Data.StatusAwalKendaraan');
    }

    public function getdata()
    {
    	$datas = Mstatusawalkendaraan::all();
        return Datatables::of($datas)
        ->addColumn('action', function ($data) {
            return '<a id="btnedit" data-toggle="modal" data-target="#modal" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }

    public function validasi(Request $r)
    {
        // if (!empty($merk)) {
        //     $el = array('id' => $id, 'merk' => $merk);
        //     $validatedData = Validator::make($el, [
        //         'merk' => [Rule::unique('mmerks')->ignore($id)],
        //     ]);
        //     if ($validatedData->passes()) {
        //         return response()->json('boleh');
        //     }
        // }   
        return response()->json('gakboleh');
    }

    public function store(Request $r)
    {
        $data = Mstatusawalkendaraan::create(['status_awal' => $r->status_awal]);
        return redirect()->action('mStatusAwalKendaraanController@index')->with('alert-success','Data Status Awal Kendaraan '.$data->status_awal.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Mstatusawalkendaraan::find($id);
        $data->update(['status_awal' => $r->status_awal]);
        return redirect()->action('mStatusAwalKendaraanController@index')->with('alert-success','Data Status Awal Kendaraan '.$data->status_awal.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mstatusawalkendaraan::all();
        }else {
            $tags = Mstatusawalkendaraan::where('status_awal', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->status_awal];
        }
        return response()->json($formatted_tags);
    }
}
