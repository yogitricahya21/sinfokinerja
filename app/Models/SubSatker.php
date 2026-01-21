<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSatker extends Model
{
    protected $fillable =
    [
        'satker_id',
        'nama_subdis'
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }
}
