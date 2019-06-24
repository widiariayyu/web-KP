<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Fungsi;
use App\KPTaksi;

class Txkp extends Model
{
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $guarded = [];

    public function detil()
    {
        return $this->hasMany('App\Txkpdetil', 'kode_kp', 'kode');
    }
    public function jenisangkutan()
    {
        return $this->belongsTo('App\Mjenisangkutan', 'mjenisangkutan_id');
    }
    public function merk()
    {
        return $this->belongsTo('App\Mmerk', 'mmerk_id');
    }
    public function mwarna()
    {
        return $this->belongsTo('App\Mwarna', 'warna');
    }
    public function perusahaan()
    {
        return $this->belongsTo('App\Mperusahaan', 'mperusahaan_id');
    }
    public function jeniskendaraan()
    {
        return $this->belongsTo('App\Mjeniskendaraan', 'mjeniskendaraan_id');
    }
    public function statusawalkendaraan()
    {
        return $this->belongsTo('App\Mstatusawalkendaraan', 'mstatusawalkendaraan_id');
    }
    public function peremajaan()
    {
        return $this->hasMany('App\Tperemajaan', 'nolambung');
    }

    public function scopeNoUnik($query, $perusahaan)
    {
      $nolambung = $query->select('nolambung')->where('mperusahaan_id', $perusahaan)->orderBy('nolambung', 'DESC')->pluck('nolambung')->first();
      return Fungsi::autoNumber(!empty($nolambung) ? $nolambung : '0000',0,4);
    }

    public function scopeIndex($query)
    {
      return $query->join('mperusahaans as p', 'txkps.mperusahaan_id', '=', 'p.id')
                   ->leftJoin('mmerks as m', 'txkps.mmerk_id', '=', 'm.id')
                   ->select('kode', 'nolambung', 'no_kp', 'no_kendaraan', 'nomor_uji', 'tahun_kendaraan', 'p.nama_perusahaan', 'p.alamat', 'm.merk', 'm.id as merkid');
    }
}