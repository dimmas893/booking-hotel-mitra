<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class FasilitasKolangRenang extends Model
{
    use HasFactory;
    protected $table = 'fasilkolamrenang';
    protected $guarded = [];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'idmitra', 'id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'idfasilitas', 'id');
    }
    public function unit()
    {
        return $this->belongsTo(UnitSewaFasilitas::class, 'idunit', 'id');
    }
    public function kesepakatan()
    {
        return $this->belongsTo(HargaSepakatMitra::class, 'idsepakatmitra', 'id');
    }
    public function perjanjian()
    {
        return $this->belongsTo(PerjanjianMitra::class, 'idperjanjianmitra', 'id');
    }
    public function fasilmitra()
    {
        return $this->belongsTo(FasilitasMitra::class, 'idfasilmitra', 'id');
    }
}
