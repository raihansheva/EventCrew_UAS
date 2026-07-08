<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    protected $table = 'penyelenggaras';

    protected $fillable = [
        'user_id',
        'nama_penyelenggara',
        'nama_penanggung_jawab',
        'no_hp',
        'alamat',
        'deskripsi',
        'status_verifikasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
