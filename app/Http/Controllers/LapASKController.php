<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Txkp;
use App\Mperusahaan;
use App\Txkpdetil;
use DB;
use PDF;

class LapASKController extends Controller
{
    public function index()
    {
      return view('laporan.ask.index');
    }

    public function semua(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $perusahaans = Mperusahaan::all();
      $kps = Txkp::with('statusawalkendaraan')->whereBetween('tgl_ditetapkan', [$tglawal, $tglakhir])->orderBy('nolambung', 'asc')->get();
      $pdf = PDF::loadView('laporan.ask.semua', compact('perusahaans', 'kps', 'tglawal', 'tglakhir'));
      return $pdf->stream('KP ASK - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function per(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $perusahaans = Mperusahaan::find($request->perusahaan);
      $perusahaans->kps = Txkp::with('statusawalkendaraan')->where('mperusahaan_id', $request->perusahaan)->whereBetween('tgl_ditetapkan', [$tglawal, $tglakhir])->orderBy('nolambung', 'asc')->get();
      // dd($perusahaans->kps);
      $pdf = PDF::loadView('laporan.ask.per', compact('perusahaans', 'tglawal', 'tglakhir'));
      return $pdf->stream('KP ASK Perusahaan '.$request->perusahaan.' - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function pendapatan(Request $request)
    {
      $tglawal = $request->tglawal.' 00:00:00';
      $tglakhir = $request->tglakhir.' 23:59:59';
      $datas = Txkpdetil::select('txkps.no_kp', 'txkps.no_kendaraan', 'txkpdetils.perpanjangan_ke', 'mperusahaans.nama_perusahaan', 'txkpdetils.tgl_perpanjangan', 'txkpdetils.bayar')
      ->join('txkps', 'txkps.kode', '=', 'txkpdetils.kode_kp')
      ->join('mperusahaans', 'txkps.mperusahaan_id', '=', 'mperusahaans.id')
      ->whereNotNull('bayar')
      ->whereBetween('tgl_bayar', [$tglawal, $tglakhir])
      ->orderBy('txkpdetils.tgl_bayar', 'asc')
      ->get();
      $total = Txkpdetil::select(DB::raw('SUM(bayar) as bayar'))
      ->whereNotNull('bayar')
      ->whereBetween('tgl_bayar', [$tglawal, $tglakhir])
      ->pluck('bayar')
      ->first();
      $pdf = PDF::loadView('laporan.ask.pendapatan', compact('datas', 'total', 'tglawal', 'tglakhir'), [], ['format' => 'Legal-L']);
      return $pdf->stream('KP ASK Pendapatan - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }

    public function rekap(Request $request)
    {
      $tglawal = $request->tglawal;
      $tglakhir = $request->tglakhir;
      $datas = Mperusahaan::select(
        'id', 
        'nama_perusahaan', 
        DB::raw('
        (SELECT IFNULL(COUNT(kode), 0) 
          FROM txkps 
          WHERE txkps.`mstatusawalkendaraan_id` = 1 
          AND txkps.`mperusahaan_id` = mperusahaans.id
        ) AS pribadi, 
        (SELECT IFNULL(COUNT(kode), 0) 
          FROM txkps 
          WHERE txkps.`mstatusawalkendaraan_id` = 2 
          AND txkps.`mperusahaan_id` = mperusahaans.id
        ) AS umum
        ')
      )->get();

      $totalumum = Txkp::select(DB::raw('IFNULL(COUNT(*), 0) AS umum'))->where('mstatusawalkendaraan_id', 2)->first();
      $totalpribadi = Txkp::select(DB::raw('IFNULL(COUNT(*), 0) AS pribadi'))->where('mstatusawalkendaraan_id', 1)->first();

      $pdf = PDF::loadView('laporan.ask.rekap', compact('datas', 'totalumum', 'totalpribadi', 'tglawal', 'tglakhir'));
      return $pdf->stream('Rekap KP ASK - '.date_format(date_create($tglawal),"d-m-Y").' / '.date_format(date_create($tglakhir),"d-m-Y").'.pdf');
    }
}
