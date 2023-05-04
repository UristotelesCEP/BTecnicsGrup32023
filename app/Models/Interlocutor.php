<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interlocutor extends Model
{
    use HasFactory;

    protected $table = 'interlocutors';
    public $timestamps = false;

    public function cartes_trucades()
    {
        return $this->hasMany(Cartes_trucades::class, 'interlocutors_id');
    }
}
