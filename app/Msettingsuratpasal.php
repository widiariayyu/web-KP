<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msettingsuratpasal extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function katperusahaan()
    {
        return $this->belongsTo('App\Mkategoriperusahaan', 'jenisperusahaan_id');
    }
}
