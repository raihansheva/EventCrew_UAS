<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanVolunteer extends Model
{
    protected $table = 'penugasan_volunteers';

    protected $fillable = [
        'pendaftaran_id',
        'tugas',
        'lokasi_tugas',
        'tanggal_tugas',
        'jam_mulai',
        'jam_selesai',
        'status_tugas',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranVolunteer::class, 'pendaftaran_id');
    }

    public function evaluasi()
    {
        return $this->hasOne(EvaluasiVolunteer::class, 'penugasan_id');
    }
}
