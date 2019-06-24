<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Mperusahaan;
use Illuminate\Validation\Rule;
use Validator;

class mPerusahaanController extends Controller
{
    public function index()
    {
    	return view('Master Data.Perusahaan');
    }

    public function getdata()
    {
        $datas = Mperusahaan::with('katperusahaan', 'wilayah')->get();

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
        $data = Mperusahaan::create([
          'id' => Mperusahaan::noUnik(),
          'mkategoriperusahaan_id' => $r->katperusahaan, 
          'nama_perusahaan' => $r->nama, 
          'pemimpin' => $r->pemimpin, 
          'alamat' => $r->alamat, 
          'mwilayah_id' => $r->wilayah, 
          'no_badan_hukum' => $r->badanhukum,
          'telp' => $r->telp
        ]);
      } catch (\Exception $e) {
        return redirect()->action('mPerusahaanController@index')->with('alert-danger','Data Perusahaan Gagal Ditambah.');
      }
      return redirect()->action('mPerusahaanController@index')->with('alert-success','Data Perusahaan '.$data->nama_perusahaan.' Berhasil Ditambah.');
    }

    public function update(Request $r, $id)
    {
      try {
        $data = Mperusahaan::find($id);
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
        return redirect()->action('mPerusahaanController@index')->with('alert-success','Data Perusahaan Gagal Diubah.');
      }
      return redirect()->action('mPerusahaanController@index')->with('alert-success','Data Perusahaan '.$data->nama_perusahaan.' Berhasil Diubah.');
    }

    public function seldata(Request $r)
    {
        $term = trim($r->q);
        if (empty($term)) {
            $tags = Mperusahaan::all();
        }else {
            $tags = Mperusahaan::where('nama_perusahaan', 'LIKE', '%'. $term .'%')->get();
        }
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama_perusahaan];
        }
        return response()->json($formatted_tags);
    }

    public function selper($id)
    {
        $perusahaan = Mperusahaan::with('katperusahaan.pasal', 'wilayah')->where('id', $id)->first();
        return response()->json($perusahaan);
    }

    public function apistore(Request $request)
    {
      try {
        $r = array_add($request['form'], 'id', Mperusahaan::noUnik());
        $data = Mperusahaan::create($r);
        $response = array(
          'status' => 'success',
          'modal' => 'modal-perusahaan',
          'select' => 'select[name=mperusahaan_id]',
          'id' => $data->id,
          'data' => $data->nama_perusahaan,
          'msg' => 'Berhasil Menambah Data Perusahaan '. $data->nama_perusahaan .' .',
        );
      } catch (Exception $e) {
        $response = array(
          'status' => 'danger',
          'modal' => 'modal-perusahaan',
          'select' => 'select[name=mperusahaan_id]',
          'id' => '',
          'data' => '',
          'msg' => 'Gagal Menambah Data Perusahaan '. $request['form']['nama_perusahaan'] .' .',
        );
      }
      return response()->json($response);
    }
}
