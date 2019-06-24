<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeremajaanTaksi extends Model
{
    protected $table = 'peremajaantaksi';
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
        return $this->belongsTo('App\TaksiPerusahaan', 'mperusahaan_id');
    }
    public function kp()
    {
        return $this->belongsTo('App\KPTaksi', 'kode_kp');
    }
    public function scopeIndex($query)
    {
        return $query->join('perusahaantaksi as p', 'peremajaantaksi.mperusahaan_id', '=', 'p.id')
                    ->join('mwilayahs as w', 'p.mwilayah_id', '=', 'w.id')
                    ->join('mmerks as m', 'peremajaantaksi.mmerk_id', '=', 'm.id')
                    ->join('mmerks as ml', 'peremajaantaksi.mmerk_id_lama', '=', 'ml.id')
                    ->select('peremajaantaksi.*', 'p.nama_perusahaan as perusahaan', 'p.alamat as alamat_perusahaan', 'w.wilayah', 'w.kota', 'm.merk as merkbaru', 'ml.merk as merklama');
    }
}
