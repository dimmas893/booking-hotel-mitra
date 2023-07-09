<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function jenismitra()
    {
        return $this->belongsTo(JenisMitra::class, 'idjenismitra', 'id');
    }

    public function perjanjianmitra()
    {
        return $this->belongsTo(PerjanjianMitra::class, 'idmitra', 'id');
    }
}
