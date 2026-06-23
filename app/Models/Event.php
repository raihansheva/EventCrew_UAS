<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'panitia_id',
        'kategori_id',
        'nama_event',
        'deskripsi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'poster',
        'status_verifikasi',
        'status_event',
    ];

    public function panitia()
    {
        return $this->belongsTo(User::class, 'panitia_id')->where('role', 'panitia');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriEvent::class, 'kategori_id');
    }
}
