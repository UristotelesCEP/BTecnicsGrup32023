<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartes_trucades_has_agencies extends Model
{
    use HasFactory;

    protected $table = 'cartes_trucades_has_agencies';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function cartes_trucades()
    {
        return $this->belongsTo(Cartes_trucades::class, 'cartes_trucades_id');
    }

    public function estat_agencies()
    {
        return $this->belongsTo(Estat_agencies::class, 'estat_agencies_id');
    }

    public function agencies()
    {
        return $this->belongsTo(Agencies::class, 'agencies_id');
    }
}
