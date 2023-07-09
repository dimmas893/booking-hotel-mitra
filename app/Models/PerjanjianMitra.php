<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjanjianMitra extends Model
{
    use HasFactory;
    protected $table = 'perjanjianmitra';
    protected $guarded = [];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }
}
