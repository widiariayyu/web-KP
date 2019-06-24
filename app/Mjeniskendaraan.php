<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mjeniskendaraan extends Model
{
    public $timestamps = false;
    protected $fillable = ['jenis'];

    public function perubahansifats()
    {
        return $this->hasMany('App\Mperubahansifat');
    }
}
