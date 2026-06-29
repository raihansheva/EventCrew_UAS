<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'pendidikan',
        'keahlian',
        'pengalaman',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}