<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable =
    [
        'judul_kegiatan',
        'deskripsi',
        'satker_id',
        'sub_satker_id',
        'status',
        'created_by'
    ];

    public function anggota()
    {
        return $this->belongsToMany(User::class, 'kegiatan_user');
    }

    public function evidences()
    {
        return $this->hasMany(KinerjaEvidence::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function subSatker()
    {
        return $this->belongsTo(SubSatker::class, 'sub_satker_id');
    }
}
