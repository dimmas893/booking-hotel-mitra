<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking_pool';
    protected $guarded = [];

    public function fasilitaskolam()
    {
        return $this->belongsTo(FasilitasKolangRenang::class, 'idfasilkolam', 'id');
    }
}
