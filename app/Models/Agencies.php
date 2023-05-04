<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agencies extends Model
{
    use HasFactory;
    protected $table = 'agencies';
    public $timestamps = false;

    public function municipi()
    {
        return $this->belongsTo(Municipi::class, 'municipis_id');
    }

    public function cartes_trucades_has_agencies()
    {
        return $this->hasMany(Cartes_trucades_has_agencies::class, 'agencies_id');
    }
}
