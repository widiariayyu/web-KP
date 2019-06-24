<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mkategoriperusahaan extends Model
{
    public $timestamps = false;
    protected $fillable = ['kategori_perusahaan'];

    public function perusahaans()
    {
        return $this->hasMany('App\Mperusahaan', 'mkategoriperusahaan_id');
    }

    public function pasal()
    {
        return $this->hasOne('App\Msettingsuratpasal', 'jenisperusahaan_id');
    }
}
