<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mjenisangkutan extends Model
{
    public $timestamps = false;
    protected $fillable = ['jenis'];

    public function kartuPengawasans()
    {
        return $this->hasMany('App\Txkp');
    }
}
