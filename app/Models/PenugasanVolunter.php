<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanVolunteer extends Model
{
    protected $table = 'penugasan_volunteer';

    protected $fillable = [
        'pendaftaran_id',
        'tugas',
        'lokasi_tugas',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PenugasanVolunteer::class, 'pendaftaran_id');
    }
}