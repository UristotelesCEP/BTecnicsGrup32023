<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuari extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuaris';
    public $timestamps = false;

    public function tipuUsuari()
    {
        return $this->belongsTo(TipusUsuari::class);
    }
}
