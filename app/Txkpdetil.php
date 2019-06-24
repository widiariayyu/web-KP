<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Txkpdetil extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function master()
    {
        return $this->belongsTo('App\Txkp', 'kode_kp', 'kode');
    }
}
