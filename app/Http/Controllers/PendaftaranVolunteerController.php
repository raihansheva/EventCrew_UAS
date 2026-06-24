<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranVolunteer;

class PendaftaranVolunteerController extends Controller
{
    public function create()
    {
        return view('pages.pendaftaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => 'required',
            'divisi_id' => 'required',
            'deskripsi' => 'nullable'
        ]);

        PendaftaranVolunteer::create([
            'volunteer_id' => $request->volunteer_id,
            'divisi_id' => $request->divisi_id,
            'deskripsi' => $request->deskripsi,
            'status_pendaftaran' => 'menunggu'
        ]);

        return redirect('/pendaftaran')
            ->with('success', 'Pendaftaran berhasil dikirim');
    }
}