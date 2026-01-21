<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    protected $fillable =
    [
        'user_id',
        'satker_asal_id',
        'satker_tujuan_id',
        'file_sk_mutasi',
        'tanggal_mutasi',
        'no_sk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function satkerAsal()
    {
        return $this->belongsTo(Satker::class, 'satker_asal_id');
    }

    public function satkerTujuan()
    {
        return $this->belongsTo(Satker::class, 'satker_tujuan_id');
    }
}
