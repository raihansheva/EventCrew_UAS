<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PendaftaranVolunteer;

class PendaftaranVolunteerController extends Controller
{
    public function create($id)
    {
        $event = Event::with('panitia', 'kategori', 'divisiVolunteer')->findOrFail($id);

        return view('pages.pendaftaran', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id'      => 'required|exists:events,id',
            'volunteer_id'  => 'required|exists:volunteers,id',
            'divisi_id'     => 'required|exists:divisi_volunteers,id',
            'motivasi'      => 'required|string|max:1000',
        ]);

        // Cek apakah volunteer sudah pernah mendaftar
        $cekPendaftaran = PendaftaranVolunteer::where('volunteer_id', $request->volunteer_id)
            ->where('divisi_id', $request->divisi_id)
            ->where('status_pendaftaran', 'menunggu')
            ->first();

        if ($cekPendaftaran) {
            return back()->with('warning', 'Anda sudah mendaftar pada divisi ini dan status pendaftaran masih menunggu.');
        }

        PendaftaranVolunteer::create([
            'event_id'            => $request->event_id,
            'volunteer_id'        => $request->volunteer_id,
            'divisi_id'           => $request->divisi_id,
            'motivasi'            => $request->motivasi,
            'status_pendaftaran'  => 'menunggu',
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
