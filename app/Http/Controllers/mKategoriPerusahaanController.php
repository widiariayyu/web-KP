<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mkategoriperusahaan;
use Illuminate\Validation\Rule;
use Validator;

class mKategoriPerusahaanController extends Controller
{
    public function index()
    {
    	return view('Master Data.KategoriPerusahaan');
    }

    public function getdata()
    {
    	$datas = Mkategoriperusahaan::all();
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
        $data = Mkategoriperusahaan::create(['kategori_perusahaan' => $r->kategori]);
        return redirect()->action('mKategoriPerusahaanController@index')->with('alert-success','Data Kategori Perusahaan '.$data->kategori_perusahaan.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Mkategoriperusahaan::find($id);
        $data->update(['kategori_perusahaan' => $r->kategori]);
        return redirect()->action('mKategoriPerusahaanController@index')->with('alert-success','Data Kategori Perusahaan '.$data->kategori_perusahaan.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mkategoriperusahaan::all();
        }else {
            $tags = Mkategoriperusahaan::where('kategori_perusahaan', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->kategori_perusahaan];
        }
        return response()->json($formatted_tags);
    }
}
