<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasMitra extends Model
{
    use HasFactory;

    protected $table = 'fasilitasmitra';
    protected $guarded = [];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'idmitra', 'id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'idfasilitas', 'id');
    }
    public function perjanjian()
    {
        return $this->belongsTo(PerjanjianMitra::class, 'idperjanjianmitra', 'id');
    }
}
