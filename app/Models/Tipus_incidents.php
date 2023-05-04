<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipus_incidents extends Model
{
    use HasFactory;

    protected $table = 'tipus_incidents';
    public $timestamps = false;

    public function incidents()
    {
        return $this->hasMany(Incidents::class, 'tipus_incidents_id');
    }
}
