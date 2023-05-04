<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estat_agencies extends Model
{
    use HasFactory;
    protected $table = 'estat_agencies';
    public $timestamps = false;

    public function cartes_trucades_has_agencies()
    {
        return $this->hasMany(Cartes_trucades_has_agencies::class, 'estat_agencies_id');
    }
}
