<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable =
    [
        'user_id',
        'nip_nrp',
        'pangkat',
        'jabatan',
        'no_hp',
        'alamat',
        'foto_personel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
