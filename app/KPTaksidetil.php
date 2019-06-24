<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KPTaksidetil extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $table = 'kptaksidetil';

    public function master()
    {
        return $this->belongsTo('App\KPTaksi', 'kode_kp', 'kode');
    }
}
