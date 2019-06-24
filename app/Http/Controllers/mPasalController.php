<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Msettingsuratpasal;
use Illuminate\Validation\Rule;
use Validator;

class mPasalController extends Controller
{
    public function index()
    {
    	return view('SettingSurat.pasal');
    }

    public function getdata()
    {
    	$datas = Msettingsuratpasal::all();
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
        $data = Msettingsuratpasal::create(['pasal_permen' => $r->pasalpermen, 'no_permen' => $r->nopermen]);
        return redirect()->action('mPasalController@index')->with('alert-success','Data Setting Surat '.$data->nopermen.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Msettingsuratpasal::find($id);
        $data->update(['pasal_permen' => $r->pasalpermen, 'no_permen' => $r->nopermen]);
        return redirect()->action('mPasalController@index')->with('alert-success','Data Setting Surat '.$data->nopermen.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Msettingsuratpasal::all();
        }else {
            $tags = Msettingsuratpasal::where('nopermen', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nopermen];
        }
        return response()->json($formatted_tags);
    }

    public function selpasal($id)
    {
    	$data = Msettingsuratpasal::find($id);
        return response()->json($data);
    }
}
