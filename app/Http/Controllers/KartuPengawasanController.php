<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Txkp;
use App\Txkpdetil;
use App\Msetting;
use Datatables;
use Fungsi;
use Auth;
use DB;
use PDF;

class KartuPengawasanController extends Controller
{
  public function index()
  {
    return view('KP.ask.index');
  }

  public function getdata()
  {
    $datas = Txkp::index()->get();
    return Datatables::of($datas)
      ->addColumn('action', function ($data) {
        return '<a href="ask/' . $data->kode . '" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="ask/cetak/' . $data->kode . '" target="_blank" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i></a> 
                <button class="btn btn-xs btn-danger" id="btn-hapus-kp"><i class="fa fa-trash"></i></button>
                <a href="ask/qr/' . $data->kode . '" target="_blank" class="btn btn-xs btn-primary"><i class=" glyphicon glyphicon-qrcode"></i></a>';
      })
      ->make(true);
  }

  public function validasi(Request $r, $perusahaan = '')
  {
    $el = array('nolambung' => $r->nolambung);
    $validatedData = Validator::make($el, [
      'nolambung' => Rule::unique('txkps')->where(function ($query) use ($perusahaan) {
        $query->where('mperusahaan_id', $perusahaan);
      })
    ]);
    if ($validatedData->passes()) {
      return response()->json(['message' => 'Pas Mantap'], 200);
    }
    return response()->json(['message' => 'No Lambung Sudah Digunakan'], 300);
  }

  public function getNoLambung($perusahaan = '')
  {
    $autonum = Txkp::noUnik($perusahaan);
    return response()->json($autonum, 200);
  }

  public function create()
  {
    $angkutan = 'ask';
    $jangkutan = 'Angkutan Sewa Khusus';
    return view('KP.form', compact('angkutan', 'jangkutan'));
  }

  public function store(Request $r)
  {
    $setting = Msetting::first();
    $biaya = $setting->biaya;
    for ($i = 1; $i <= 4; $i++) {
      $tgl[$i] = date("Y-m-d", strtotime($r->tglsk . " +" . $i . " year"));
    }
    DB::beginTransaction();
    try {
      $master = Txkp::create([
        'kode' => 'ASK-' . $r->perusahaan . '-' . $r->nolambung,
        'nolambung' => $r->nolambung,
        'no_sk_gub' => $r->nosk,
        'tgl_sk_gub' => $r->tglsk,
        'tgl_akhir' => $tgl[4],
        'mstatusawalkendaraan_id' => $r->sak,
        'mperusahaan_id' => $r->perusahaan,
        'no_kendaraan' => $r->nokendaraan,
        'tahun_kendaraan' => $r->tahunkendaraan,
        'mmerk_id' => $r->merkkendaraan,
        'mjeniskendaraan_id' => $r->jeniskendaraan,
        'pemilik' => $r->pemilik,
        'alamat' => $r->alamatkendaraan,
        'nomor_uji' => $r->nouji,
        'isi_silinder' => $r->isisilinder,
        'jbi' => $r->jbi,
        'daya_orang' => $r->dayaorang,
        'daya_barang' => $r->dayabarang,
        'tgl_ditetapkan' => $r->ditetaptgl,
        'mjenisangkutan_id' => 3,
        'no_kp' => $setting->nomor_surat_kp_1 . '.0' . $r->perusahaan . '/' . $r->nolambung . '/ASK.' . $r->perusahaan . '/DISPMPT-' . date('Y'),
        'warna' => $r->warna,
        'tgl1' => $r->tglsk,
        'tgl2' => $tgl[1],
        'tgl3' => $tgl[2],
        'tgl4' => $tgl[3],
        'tgl5' => $tgl[4]
      ]);

      Txkpdetil::create([
        'kode_kp' => $master->kode,
        'perpanjangan_ke' => 1,
        'tgl_perpanjangan' => $r->tglsk,
        'user_id' => Auth::User()->id,
        'bayar' => $biaya,
        'tgl_bayar' => date('Y-m-d')
      ]);

      for ($i = 1; $i <= 4; $i++) {
        Txkpdetil::create([
          'kode_kp' => $master->kode,
          'perpanjangan_ke' => $i + 1,
          'user_id' => Auth::User()->id,
          'tgl_perpanjangan' => $tgl[$i]
        ]);
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->action('KartuPengawasanController@index')->with('alert-danger', 'Kartu Pengawasan Gagal Dibuat.');
    }
    return redirect()->action('KartuPengawasanController@index')->with('alert-success', 'Kartu Pengawasan ' . $master->nolambung . ' Berhasil Dibuat.');
  }

  public function apiStore(Request $request)
  {
    $r = $request['form'];
    $setting = Msetting::first();
    $biaya = $setting->biaya;
    for ($i = 1; $i <= 4; $i++) {
      $tgl[$i] = date("Y-m-d", strtotime($r['tglsk'] . " +" . $i . " year"));
    }
    DB::beginTransaction();
    try {
      $master = Txkp::create([
        'kode' => "ASK-" . $r['perusahaan'] . "-" . $r['nolambung'],
        'nolambung' => $r['nolambung'],
        'no_sk_gub' => $r['nosk'],
        'tgl_sk_gub' => $r['tglsk'],
        'tgl_akhir' => $tgl[4],
        'mstatusawalkendaraan_id' => $r['sak'],
        'mperusahaan_id' => $r['perusahaan'],
        'no_kendaraan' => $r['nokendaraan'],
        'tahun_kendaraan' => $r['tahunkendaraan'],
        'mmerk_id' => $r['merkkendaraan'],
        'mjeniskendaraan_id' => $r['jeniskendaraan'],
        'pemilik' => $r['pemilik'],
        'alamat' => $r['alamatkendaraan'],
        'nomor_uji' => $r['nouji'],
        'isi_silinder' => $r['isisilinder'],
        'jbi' => $r['jbi'],
        'daya_orang' => $r['dayaorang'],
        'daya_barang' => $r['dayabarang'],
        'tgl_ditetapkan' => $r['ditetaptgl'],
        'mjenisangkutan_id' => 3,
        'no_kp' => $setting->nomor_surat_kp_1 . ".0" . $r['perusahaan'] . "/" . $r['nolambung'] . "/ASK." . $r['perusahaan'] . "/DISPMPT-" . date('Y'),
        'warna' => $r['warna'],
        'tgl1' => $r['tglsk'],
        'tgl2' => $tgl[1],
        'tgl3' => $tgl[2],
        'tgl4' => $tgl[3],
        'tgl5' => $tgl[4]
      ]);

      Txkpdetil::create([
        'kode_kp' => $master->kode,
        'perpanjangan_ke' => 1,
        'tgl_perpanjangan' => $r['tglsk'],
        'user_id' => Auth::User()->id,
        'bayar' => $biaya,
        'tgl_bayar' => date('Y-m-d')
      ]);

      for ($i = 1; $i <= 4; $i++) {
        Txkpdetil::create([
          'kode_kp' => $master->kode,
          'perpanjangan_ke' => $i + 1,
          'user_id' => Auth::User()->id,
          'tgl_perpanjangan' => $tgl[$i]
        ]);
      }
      DB::commit();
      return response()->json(['msg' => 'Kartu Pengawasan Berhasil Dibuat.', 'data' => $master->kode], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['msg' => 'Kartu Pengawasan Gagal Dibuat.'], 400);
    }
  }

  public function edit($id)
  {
    $angkutan = 'ask';
    $jangkutan = 'Angkutan Sewa Khusus';
    $data = Txkp::find($id);
    return view('KP.form-edit', compact('angkutan', 'jangkutan', 'data'));
  }

  public function update(Request $request, $id)
  {
    $r = $request->all();
    try {
      $data = Txkp::find($id);
      $data->update([
        'no_kendaraan' => $r['nokendaraan'],
        'tahun_kendaraan' => $r['tahunkendaraan'],
        'mmerk_id' => $r['merkkendaraan'],
        'mjeniskendaraan_id' => $r['jeniskendaraan'],
        'pemilik' => $r['pemilik'],
        'alamat' => $r['alamatkendaraan'],
        'nomor_uji' => $r['nouji'],
        'isi_silinder' => $r['isisilinder'],
        'jbi' => $r['jbi'],
        'daya_orang' => $r['dayaorang'],
        'daya_barang' => $r['dayabarang'],
        'tgl_ditetapkan' => $r['ditetaptgl'],
        'warna' => $r['warna']
      ]);
      return redirect()->action('KartuPengawasanController@index')->with('alert-success', 'Kartu Pengawasan ' . $id . ' Berhasil Diubah.');
    } catch (\Exception $e) {
      return redirect()->action('KartuPengawasanController@index')->with('alert-danger', 'Kartu Pengawasan ' . $id . ' Berhasil Diubah.');
    }
  }

  public function apiUpdate(Request $request, $id)
  {
    $r = $request['form'];
    try {
      $data = Txkp::find($id);
      $data->update([
        'no_kendaraan' => $r['nokendaraan'],
        'tahun_kendaraan' => $r['tahunkendaraan'],
        'mmerk_id' => $r['merkkendaraan'],
        'mjeniskendaraan_id' => $r['jeniskendaraan'],
        'pemilik' => $r['pemilik'],
        'alamat' => $r['alamatkendaraan'],
        'nomor_uji' => $r['nouji'],
        'isi_silinder' => $r['isisilinder'],
        'jbi' => $r['jbi'],
        'daya_orang' => $r['dayaorang'],
        'daya_barang' => $r['dayabarang'],
        'tgl_ditetapkan' => $r['ditetaptgl'],
        'warna' => $r['warna']
      ]);
      return response()->json(['msg' => 'Kartu Pengawasan Berhasil Diubah.', 'data' => $data->kode], 200);
    } catch (\Exception $e) {
      return response()->json(['msg' => 'Kartu Pengawasan Gagal Diubah.'], 400);
    }
  }

  public function cetak($id)
  {
    $daftarulang = array('I', 'II', 'III', 'IV');
    $data = Txkp::find($id);
    $data->detil;
    $perusahaan = $data->perusahaan;
    $warna = $data->mwarna;
    $katperusahaan = $perusahaan->katperusahaan;
    $wilperusahaan = $perusahaan->wilayah;
    $merk = $data->merk;
    $jeniskendaraan = $data->jeniskendaraan;
    $setting = Msetting::first();
    $pdf = PDF::loadView('KP.ask.cetak', compact('data', 'perusahaan', 'katperusahaan', 'wilperusahaan', 'merk', 'jeniskendaraan', 'setting', 'daftarulang', 'warna'));
    return $pdf->stream($data->no_kp . '.pdf');
  }

  public function qr($id)
  {
    $data = Txkp::find($id);
    $data->perusahaan;
    $jos = [
      'kode' => 'ASK',
      'nama' => 'ANGKUTAN SEWA KHUSUS'
    ];
    $setting = Msetting::first();
    $pdf = PDF::loadView('KP.qr', compact('data', 'setting', 'jos'), [], ['format' => array(86, 54)]);
    return $pdf->stream($data->no_kp . '.pdf');
  }

  public function delete($id)
  {
    DB::beginTransaction();
    try {
      $kp = Txkp::destroy($id);
      $detil = Txkpdetil::where('kode_kp', $id)->delete();
      DB::commit();
      return response()->json(['msg' => 'Kartu Pengawasan Berhasil Dihapus.'], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['msg' => 'Kartu Pengawasan Gagal Dihapus.'], 500);
    }
  }
}
