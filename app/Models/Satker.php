<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $fillable =
    [
        'nama_satker',
        'kode_satker'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'current_satker_id');
    }

    public function subSatkers()
    {
        return $this->hasMany(SubSatker::class);
    }
}
