<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ViewKP extends Model
{
  public $incrementing = false;
  protected $fillable = [];
  protected $table = 'kp';

  public function detils()
  {
    return $this->hasMany('App\Txkpdetil', 'txkp_nolambung', 'nolambung');
  }

  public function scopeLewat($query)
  {
    return $query->select('kp.nolambung', 
      'kp.no_kendaraan', 
      'kp.no_kp', 
      'kp.pemilik', 
      'kp.mperusahaan_id', 
      'perusahaan.telp as phone_number', 
      'perusahaan.nama_perusahaan', 
      'kpdetil.tgl_perpanjangan', 
      DB::raw('DATEDIFF("'. date('Y-m-d') .'", kpdetil.tgl_perpanjangan) AS lewat'),
      DB::raw('CONCAT("Kartu Pengawasan No. ", kp.no_kp, " No. Kendaraan ", kp.no_kendaraan, " Pemilik ", kp.pemilik, " dari Perusahaan ", perusahaan.nama_perusahaan, " Sudah Melewati ", DATEDIFF("'. date('Y-m-d') .'", kpdetil.tgl_perpanjangan), " Hari dari Jatuh Tempo ", DATE_FORMAT(kpdetil.tgl_perpanjangan, "%d-%m-%Y")) AS message')
    )
    ->leftJoin('kpdetil', 'kp.kode', '=', 'kpdetil.kode_kp')
    ->leftJoin('perusahaan', function ($join) {
      $join->on('kp.mperusahaan_id', '=', 'perusahaan.id')
           ->on('kp.mjenisangkutan_id', '=', 'perusahaan.jenisangkutan');
    })
    ->whereNull('kpdetil.bayar')
    ->whereDate('kpdetil.tgl_perpanjangan', '<', date('Y-m-d'));
  }

  public function scopeBelum($query, $hari = 0)
  {
    return $query->select('kp.nolambung', 
      'kp.no_kendaraan', 
      'kp.no_kp', 
      'kp.pemilik', 
      'kp.mperusahaan_id', 
      'perusahaan.telp as phone_number', 
      'perusahaan.nama_perusahaan', 
      'kpdetil.tgl_perpanjangan', 
      DB::raw('DATEDIFF(kpdetil.tgl_perpanjangan, "'. date('Y-m-d') .'") AS sisa'),
      DB::raw('CONCAT("Kartu Pengawasan No. ", kp.no_kp, " No. Kendaraan ", kp.no_kendaraan, " Pemilik ", kp.pemilik, " dari Perusahaan ", perusahaan.nama_perusahaan, " Sisa ", DATEDIFF(kpdetil.tgl_perpanjangan, "'. date('Y-m-d') .'"), " Hari dari Jatuh Tempo ", DATE_FORMAT(kpdetil.tgl_perpanjangan, "%d-%m-%Y")) AS message')
    )
    ->leftJoin('kpdetil', 'kp.kode', '=', 'kpdetil.kode_kp')
    ->leftJoin('perusahaan', function ($join) {
      $join->on('kp.mperusahaan_id', '=', 'perusahaan.id')
           ->on('kp.mjenisangkutan_id', '=', 'perusahaan.jenisangkutan');
    })
    ->whereNull('kpdetil.bayar')
    ->whereBetween(DB::raw('DATEDIFF(kpdetil.tgl_perpanjangan, "'. date('Y-m-d') .'")'), [0, $hari]);
  }
}
