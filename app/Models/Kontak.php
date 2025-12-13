<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nomor_telepon',
        'email',
        'alamat',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI MANY-TO-MANY
    public function grups()
    {
        return $this->belongsToMany(Grup::class, 'grup_kontak', 'kontak_id', 'grup_id');
    }
}
