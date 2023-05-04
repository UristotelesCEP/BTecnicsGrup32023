<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipusUsuari extends Model
{
    protected $table = 'tipus_usuaris';
    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany(Usuari::class, 'tipus_usuaris_id');
    }
}
