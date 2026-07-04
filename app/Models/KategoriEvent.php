<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriEvent extends Model
{
    protected $table = 'kategori_events';

    protected $fillable = [
        'nama_kategori',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'kategori_id');
    }
}
