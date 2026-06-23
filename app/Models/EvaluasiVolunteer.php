<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiVolunteer extends Model
{
    protected $table = 'evaluasi_volunteers';

    protected $fillable = [
        'volunteer_id',
        'event_id',
        'nilai',
        'komentar',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id')->where('role', 'volunteer');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
