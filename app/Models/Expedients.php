<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedients extends Model
{
    use HasFactory;

    protected $table = 'expedients';
    protected $primaryKey = 'id';
    public $timestamp = false;

    public function estatExpedient()
    {
        return $this->belongsTo(Estat_expedients::class, 'estat_expedients_id');
    }

    public function cartesTrucades()
    {
        return $this->hasMany(Cartes_trucades::class, 'expedients_id');
    }


}
