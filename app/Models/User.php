<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'current_satker_id',
        'current_sub_satker_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'current_satker_id');
    }

    // Relasi Many-to-Many untuk kerja kelompok
    public function kegiatans()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_user');
    }

    public function evidences()
    {
        return $this->hasMany(KinerjaEvidence::class);
    }

    public function subSatker()
    {
        return $this->belongsTo(SubSatker::class, 'current_sub_satker_id');
    }
}
