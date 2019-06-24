<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KPTaksi;
use App\TaksiPerusahaan;
use App\KPTaksidetil;
use DB;
use PDF;

class LapTaksiController extends Controller
{
    public function index()
    {
      return view('laporan.taksi.index');
    }

    public function semua(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $perusahaans = TaksiPerusahaan::all();
      $kps = KPTaksi::with('statusawalkendaraan')->whereBetween('tgl_ditetapkan', [$tglawal, $tglakhir])->orderBy('nolambung', 'asc')->get();
      $pdf = PDF::loadView('laporan.taksi.semua', compact('perusahaans', 'kps', 'tglawal', 'tglakhir'));
      return $pdf->stream('KP Taksi - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function per(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $perusahaans = TaksiPerusahaan::find($request->perusahaan);
      $perusahaans->kps = KPTaksi::with('statusawalkendaraan')->where('mperusahaan_id', $request->perusahaan)->whereBetween('tgl_ditetapkan', [$tglawal, $tglakhir])->orderBy('nolambung', 'asc')->get();
      // dd($perusahaans->kps);
      $pdf = PDF::loadView('laporan.taksi.per', compact('perusahaans', 'tglawal', 'tglakhir'));
      return $pdf->stream('KP Taksi Perusahaan '.$request->perusahaan.' - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function pendapatan(Request $request)
    {
      $tglawal = $request->tglawal.' 00:00:00';
      $tglakhir = $request->tglakhir.' 23:59:59';
      $datas = KPTaksidetil::select('kptaksi.no_kp', 'kptaksi.no_kendaraan', 'kptaksidetil.perpanjangan_ke', 'perusahaantaksi.nama_perusahaan', 'kptaksidetil.tgl_perpanjangan', 'kptaksidetil.bayar')
      ->join('kptaksi', 'kptaksi.kode', '=', 'kptaksidetil.kode_kp')
      ->join('perusahaantaksi', 'kptaksi.mperusahaan_id', '=', 'perusahaantaksi.id')
      ->whereNotNull('bayar')
      ->whereBetween('tgl_bayar', [$tglawal, $tglakhir])
      ->orderBy('kptaksidetil.tgl_bayar', 'asc')
      ->get();
      $total = KPTaksidetil::select(DB::raw('SUM(bayar) as bayar'))
      ->whereNotNull('bayar')
      ->whereBetween('tgl_bayar', [$tglawal, $tglakhir])
      ->pluck('bayar')
      ->first();
      $pdf = PDF::loadView('laporan.taksi.pendapatan', compact('datas', 'total', 'tglawal', 'tglakhir'), [], ['format' => 'Legal-L']);
      return $pdf->stream('KP Taksi Pendapatan - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function rekap(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $datas = TaksiPerusahaan::select(
        'id', 
        'nama_perusahaan', 
        DB::raw('
        (SELECT IFNULL(COUNT(kode), 0) 
          FROM kptaksi 
          WHERE kptaksi.`mstatusawalkendaraan_id` = 1 
          AND kptaksi.`mperusahaan_id` = perusahaantaksi.id
        ) AS pribadi, 
        (SELECT IFNULL(COUNT(kode), 0) 
          FROM kptaksi 
          WHERE kptaksi.`mstatusawalkendaraan_id` = 2 
          AND kptaksi.`mperusahaan_id` = perusahaantaksi.id
        ) AS umum
        ')
      )->get();

      $totalumum = KPTaksi::select(DB::raw('IFNULL(COUNT(*), 0) AS umum'))->where('mstatusawalkendaraan_id', 2)->first();
      $totalpribadi = KPTaksi::select(DB::raw('IFNULL(COUNT(*), 0) AS pribadi'))->where('mstatusawalkendaraan_id', 1)->first();

      $pdf = PDF::loadView('laporan.taksi.rekap', compact('datas', 'totalumum', 'totalpribadi', 'tglawal', 'tglakhir'));
      return $pdf->stream('Rekap KP Taksi - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }
}
