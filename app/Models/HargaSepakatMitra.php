<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSepakatMitra extends Model
{
    use HasFactory;
    protected $table = 'hargasepakatmitra';
    protected $guarded = [];

    public function perjanjian()
    {
        return $this->belongsTo(PerjanjianMitra::class, 'idperjanjianmitra', 'id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'idfasilitas', 'id');
    }
}
