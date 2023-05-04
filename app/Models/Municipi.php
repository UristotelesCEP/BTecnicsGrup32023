<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipi extends Model
{
    use HasFactory;

    protected $table = 'municipis';
    public $timestamps = false;

    public function comarca()
    {
        return $this->belongsTo(Comarca::class, 'comarques_id');
    }


}
