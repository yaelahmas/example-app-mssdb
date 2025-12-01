<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['tanggal_type', 't_komoditas_kode', 'produksi'];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 't_komoditas_kode', 't_komoditas_kode');
    }
}
