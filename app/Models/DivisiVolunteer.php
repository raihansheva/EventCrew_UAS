<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisiVolunteer extends Model
{
    protected $table = 'divisi_volunteers';

    protected $fillable = [
        'event_id',
        'nama_divisi',
        'deskripsi',
        'kuota_volunteer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
