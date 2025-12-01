<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $table = 't_komoditas';
    protected $fillable = ['t_komoditas_kode', 'nama'];
}
