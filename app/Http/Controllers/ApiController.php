<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Txkp;
use App\ViewKP;
use App\Txkpdetil;
use App\KPTaksi;
use App\KPTaksidetil;
use App\Msetting;

class ApiController extends Controller
{
		public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }

    public function monitoringASK($id)
    {
	    header('Access-Control-Allow-Origin: *');
			$data = Txkp::with('perusahaan')->where('kode', $id)->first();
			$detil = Txkpdetil::where('kode_kp', $id)->whereNull('bayar')->first();
			$biaya = Msetting::select('biaya')->first();
			$result = [];
			if (!empty($data)) {
				$data->perusahaan;
				if (!empty($detil)) {
					$result["jatuh_tempo"] = date('d-m-Y', strtotime($detil->tgl_perpanjangan));
					$diff = date_diff(date_create(date('Y-m-d')), date_create($detil->tgl_perpanjangan));
					$result["sisa"] = $diff->format("%a");
					$result["tagihan"] = $biaya['biaya'];
				}else{
					$result["jatuh_tempo"] = 'Tidak Tersedia - Sudah Lima Kali';
					$result["sisa"] = 'Tidak Tersedia - Sudah Lima Kali';
					$result["tagihan"] = 0;
				}
				$result["no_lambung"] = $data->nolambung;
				$result["no_kp"] = $data->no_kp;
				$result["tgl_registrasi"] = date('d-m-Y', strtotime($data->tgl_ditetapkan));
				$result["pemegang_ijin"] = $data->perusahaan->nama_perusahaan;
				$result["telp"] = $data->perusahaan->telp;
				$result["alamat"] = $data->perusahaan->alamat;
      }
			return response()->json($result);
		}
		
		public function monitoringTaksi($id)
    {
	    header('Access-Control-Allow-Origin: *');
			$data = KPTaksi::with('perusahaan')->where('kode', $id)->first();
			$detil = KPTaksidetil::where('kode_kp', $id)->whereNull('bayar')->first();
			$biaya = Msetting::select('biaya')->first();
			$result = [];
			if (!empty($data)) {
				$data->perusahaan;
				if (!empty($detil)) {
					$result["jatuh_tempo"] = date('d-m-Y', strtotime($detil->tgl_perpanjangan));
					$diff = date_diff(date_create(date('Y-m-d')), date_create($detil->tgl_perpanjangan));
					$result["sisa"] = $diff->format("%a");
					$result["tagihan"] = $biaya['biaya'];
				}else{
					$result["jatuh_tempo"] = 'Tidak Tersedia - Sudah Lima Kali';
					$result["sisa"] = 'Tidak Tersedia - Sudah Lima Kali';
					$result["tagihan"] = 0;
				}
				$result["no_lambung"] = $data->nolambung;
				$result["no_kp"] = $data->no_kp;
				$result["tgl_registrasi"] = date('d-m-Y', strtotime($data->tgl_ditetapkan));
				$result["pemegang_ijin"] = $data->perusahaan->nama_perusahaan;
				$result["telp"] = $data->perusahaan->telp;
				$result["alamat"] = $data->perusahaan->alamat;
      }
			return response()->json($result);
    }

    public function jatuhtempo()
    {
			$datas = ViewKP::belum(600)->get();
			foreach ($datas as $k => $v) {
				$v->tgl_perpanjangan = date('d-m-Y', strtotime($v->tgl_perpanjangan));
			}
      return response()->json($datas);
    }

    public function lewatjatuhtempo()
    {
			$datas = ViewKP::lewat()->get();
			foreach ($datas as $k => $v) {
				$v->tgl_perpanjangan = date('d-m-Y', strtotime($v->tgl_perpanjangan));
			}
      return response()->json($datas);
    }
}
