<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranVolunteer extends Model
{
    protected $table = 'pendaftaran_volunteers';

    protected $fillable = [
        'volunteer_id',
        'divisi_id',
        'deskripsi',
        'status_pendaftaran',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

    public function divisi()
    {
        return $this->belongsTo(DivisiVolunteer::class, 'divisi_id');
    }
}
