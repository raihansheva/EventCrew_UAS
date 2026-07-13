<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiVolunteer extends Model
{
    protected $table = 'evaluasi_volunteers';

    protected $fillable = [
        'penugasan_id',
        'nilai',
        'komentar',
    ];

    public function penugasan()
    {
        return $this->belongsTo(PenugasanVolunteer::class, 'penugasan_id');
    }
}
