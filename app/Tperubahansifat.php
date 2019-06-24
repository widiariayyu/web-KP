<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tperubahansifat extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function merk()
    {
        return $this->belongsTo('App\Mmerk', 'mmerk_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function perusahaan()
    {
        return $this->belongsTo('App\Mperusahaan', 'mperusahaan_id');
    }
    public function jeniskendaraan()
    {
        return $this->belongsTo('App\Mjeniskendaraan', 'mjeniskendaraan_id');
    }
    public function suratpasal()
    {
        return $this->belongsTo('App\Msettingsuratpasal', 'msettingsuratpasal_id');
    }
    public function wilayahPemilik()
    {
        return $this->belongsTo('App\Mwilayah', 'wilayah_id');
    }

}
