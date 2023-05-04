<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartes_Trucades extends Model
{
    use HasFactory;

    protected $table = 'cartes_trucades';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function expedients()
    {
        return $this->belongsTo(Expedients::class, 'expedients_id');
    }

    public function interlocutor()
    {
        return $this->belongsTo(Interlocutor::class, 'interlocutors_id');
    }

    public function tipusLocalitzacio()
    {
        return $this->belongsTo(TipusLocalitzacions::class, 'tipus_localitzacions_id');
    }

    public function municipi()
    {
        return $this->belongsTo(Municipi::class, 'municipis_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincies_id');
    }

    public function incident()
    {
        return $this->belongsTo(Incidents::class, 'incidents_id');
    }

    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'usuaris_id');
    }

    public function cartes_trucades_has_agencies()
    {
        return $this->hasMany(Cartes_trucades_has_agencies::class, 'cartes_trucades_id');
    }
}
