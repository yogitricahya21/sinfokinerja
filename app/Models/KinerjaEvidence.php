<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KinerjaEvidence extends Model
{
    protected $table = 'kinerja_evidences';

    protected $fillable =
    [
        'kegiatan_id',
        'user_id',
        'foto_kegiatan',
        'catatan'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        // Parameter: (ModelTujuan, NamaTabelPivot, FK_Evidence, FK_User)
        return $this->belongsToMany(User::class, 'kinerja_evidence_user', 'kinerja_evidence_id', 'user_id')
                    ->withTimestamps(); // Supaya tahu kapan mereka ditambahkan ke kelompok
    }
}
