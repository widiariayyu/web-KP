<?php

namespace App\Models\ASK;

use Illuminate\Database\Eloquent\Model;
use Auth;

class KPSK extends Model
{
#deklarasi
    protected $table = 'ask_kp_sk';
    protected $fillable = [
        'IdPerusahaan', 'NoInduk', 'NoPermohonan', 'TglPermohonan', 'SKPelaksanaan', 'TglPelaksanaan', 'SKPenyelenggaraan', 'TglPenyelenggaraan', 'created_by'
    ];

#relasi
    public function perusahaan()
    {
        return $this->belongsTo('App\Mperusahaan', 'IdPerusahaan');
    }

    public function kps()
    {
        return $this->hasMany('App\Txkp', 'no_sk_gub', 'SKPenyelenggaraan');
    }

#query
    public function tambah(array $data)
    {
        $store = array_merge($data, ['created_by' => Auth::id()]);
        return $this->create($store);
    }

    public function dt()
    {
        return $this->with('perusahaan:id,nama_perusahaan')->get();
    }
}