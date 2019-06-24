<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tperemajaan extends Model
{
    protected $table = 'tperemajaan';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function merk()
    {
        return $this->belongsTo('App\Mmerk', 'mmerk_id');
    }
    public function merklama()
    {
        return $this->belongsTo('App\Mmerk', 'mmerk_id_lama');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function perusahaan()
    {
        return $this->belongsTo('App\Mperusahaan', 'mperusahaan_id');
    }
    public function kp()
    {
        return $this->belongsTo('App\Txkp', 'kode_kp');
    }
    public function scopeIndex($query)
    {
        return $query->join('mperusahaans as p', 'tperemajaan.mperusahaan_id', '=', 'p.id')
                     ->join('mwilayahs as w', 'p.mwilayah_id', '=', 'w.id')
                     ->join('mmerks as m', 'tperemajaan.mmerk_id', '=', 'm.id')
                     ->join('mmerks as ml', 'tperemajaan.mmerk_id_lama', '=', 'ml.id')
                     ->select('tperemajaan.*', 'p.nama_perusahaan as perusahaan', 'p.alamat as alamat_perusahaan', 'w.wilayah', 'w.kota', 'm.merk as merkbaru', 'ml.merk as merklama');
    }
}
