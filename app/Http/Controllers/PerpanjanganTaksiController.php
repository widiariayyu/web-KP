<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KPTaksi;
use App\KPTaksidetil;
use App\Mperusahaan;
use Datatables;
use Fungsi;
use Auth;
use DB;
use App\Msetting;

class PerpanjanganTaksiController extends Controller
{
  public function __construct()
  {
    header('Access-Control-Allow-Origin: *');
  }

  public function index()
	{
		return view('perpanjangan.taksi.index');
	}

	public function getdata($id)
	{
    $data = KPTaksi::where('kode', $id)->first();
		$detil = KPTaksidetil::where('kode_kp', $id)->whereNull('bayar')->first();
		if (!empty($data)) {
			$data->perusahaan;
			$data = $data->toArray();
			if (!empty($detil)) {
				$data["jatuh_tempo"] = $detil->tgl_perpanjangan;
				$diff=date_diff(date_create(date('Y-m-d')),date_create($data["jatuh_tempo"]));
				$data["sisa"] = $diff->format("%a");
				$data["detilid"] = $detil->id;
			}else{
				$data["jatuh_tempo"] = 'Tidak Tersedia - Sudah Lima Kali';
				$data["sisa"] = 'Tidak Tersedia - Sudah Lima Kali';
				$data["detilid"] = '';
			}
		}
		return response()->json($data);
	}

  public function detail($id = null)
  {
  	$datas = KPTaksidetil::where('kode_kp', $id)->where('bayar', '>', 0)->get();
		return Datatables::of($datas)
			->editColumn('bayar', function ($data) {
				return $data->bayar ? 'Rp. '.number_format($data->bayar,2,",",".") : '';
			})
			->addColumn('lambat', function ($data) {
				$perpanjangan=date_create("2018-02-22");
				$bayar=date_create("2018-02-21 00:00:00");
				if ($perpanjangan < $bayar) {
					$diff=date_diff($perpanjangan,$bayar);
					return $diff->format("%a");
				}
				return 0;
			})
			->make(true);
		}

	public function bayar($id)
	{
		$biaya = Msetting::select('biaya')->first();
		$biaya = $biaya->biaya;
		$data = KPTaksidetil::find($id);
		try {
			$data->update(['user_id' => Auth::User()->id,
				        'bayar' => $biaya,
				        'tgl_bayar' => date("Y-m-d H:i:s")]);
		} catch (Exception $e) {
			return response()->json('gagal');
		}
		return response()->json($data->kode_kp);
	}
}
