<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comarca extends Model
{
    use HasFactory;

    protected $table = 'comarques';
    public $timestamps = false;

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincies_id');
    }

    public function municipis()
    {
        return $this->hasMany(Municipi::class, 'comarques_id');
    }
}
