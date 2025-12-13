<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'deskripsi',
        'foto',
    ];

    public function kontaks()
    {
        return $this->belongsToMany(Kontak::class, 'grup_kontak', 'grup_id', 'kontak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
