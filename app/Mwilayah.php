<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mwilayah extends Model
{
    public $timestamps = false;
    protected $fillable = ['wilayah', 'kota'];

    public function perusahaans()
    {
        return $this->hasMany('App\Mperusahaan');
    }
}
