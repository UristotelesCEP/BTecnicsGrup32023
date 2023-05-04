<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $table = 'provincies';
    public $timestamps = false;

    public function comarcas()
    {
        return $this->hasMany(Comarca::class, 'provincies_id');
    }
}
