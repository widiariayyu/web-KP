<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Msetting;
use Illuminate\Validation\Rule;
use Validator;

class mSettingController extends Controller
{
    public function index()
    {
    	return view('SettingSurat.kp');
    }

    public function getdata()
    {
    	$datas = Msetting::all();
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
        $data = Msetting::create(['nomor_surat_kp_1' => $r->kp1, 'nomor_surat_kp_2' => $r->kp2, 'nomor_surat_kp_3' => $r->kp3, 'kadis' => $r->kadis, 'jabatan' => $r->jabatan, 'nip' => $r->nip, 'biaya' => $r->biaya]);
        return redirect()->action('mSettingController@index')->with('alert-success','Data Setting Surat Kartu Pengawasan '.$data->nama_perusahaan.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
        $data = Msetting::find($id);
        $data->update(['nomor_surat_kp_1' => $r->kp1, 'nomor_surat_kp_2' => $r->kp2, 'nomor_surat_kp_3' => $r->kp3, 'kadis' => $r->kadis, 'jabatan' => $r->jabatan, 'nip' => $r->nip, 'biaya' => $r->biaya, 'tahunkendaraan' => $r->tahunkendaraan]);
        return redirect()->action('mSettingController@index')->with('alert-success','Data Setting Surat Kartu Pengawasan '.$data->nama_perusahaan.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Msetting::all();
        }else {
            $tags = Msetting::where('nomor_surat_kp_1', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nomor_surat_kp_1];
        }
        return response()->json($formatted_tags);
    }
}
