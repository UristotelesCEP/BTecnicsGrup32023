<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidents extends Model
{
    use HasFactory;

    protected $table = 'incidents';
    public $timestamps = false;

    public function cartes_trucades()
    {
        return $this->hasMany(Cartes_trucades::class, 'incidents_id');
    }

    public function tipus_incidents()
    {
        return $this->belongsTo(Tipus_incidents::class, 'tipus_incidents_id');
    }
}
