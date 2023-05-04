<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipusLocalitzacio extends Model
{
    use HasFactory;
    protected $table = 'tipus_localitzacions';
    public $timestamps = false;

    public function cartes_trucades()
    {
        return $this->hasMany(Cartes_trucades::class, 'tipus_localitzacions_id');
    }
}
