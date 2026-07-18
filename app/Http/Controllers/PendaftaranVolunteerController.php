<?php

namespace App\Http\Controllers;

use App\Mail\StatusPendaftaranVolunteerMail;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PendaftaranVolunteer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PendaftaranVolunteerController extends Controller
{
    public function create($id)
    {
        $event = Event::with('panitia', 'kategori', 'divisiVolunteer')->findOrFail($id);

        return view('pages.pendaftaran', compact('event'));
    }

    public function dataPendaftaran()
    {
        $panitiaId = Auth::id();

        $pendaftaran = PendaftaranVolunteer::with(['volunteer', 'event', 'divisi'])
            ->whereHas('event', function ($query) use ($panitiaId) {
                $query->where('panitia_id', $panitiaId);
            })
            ->get();

        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:diterima,ditolak',
        ]);

        $pendaftaran = PendaftaranVolunteer::with([
            'volunteer.user',
            'event',
            'divisi'
        ])->findOrFail($id);

        // Jika sudah diverifikasi sebelumnya
        if ($pendaftaran->status_pendaftaran != 'menunggu') {
            return back()->with('warning', 'Pendaftaran ini sudah diverifikasi.');
        }

        // Jika diterima, cek kuota
        if ($request->status_pendaftaran == 'diterima') {

            if ($pendaftaran->divisi->kuota_volunteer <= 0) {
                return back()->with('warning', 'Kuota volunteer pada divisi ini sudah penuh.');
            }

            // Kurangi kuota
            $pendaftaran->divisi->decrement('kuota_volunteer');
        }

        // Update status
        $pendaftaran->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        // Reload relasi agar status terbaru ikut terkirim
        $pendaftaran->refresh();
        $pendaftaran->load([
            'volunteer.user',
            'event',
            'divisi'
        ]);

        // Kirim email
        Mail::to($pendaftaran->volunteer->user->email)
            ->send(new StatusPendaftaranVolunteerMail($pendaftaran));

        if ($request->status_pendaftaran == 'diterima') {
            return back()->with('success', 'Volunteer berhasil diterima dan email telah dikirim.');
        }

        return back()->with('success', 'Volunteer berhasil ditolak dan email telah dikirim.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'volunteer_id' => 'required',
            'divisi_id' => 'required',
            'deskripsi' => 'nullable'
        ]);

        PendaftaranVolunteer::create([
            'event_id' => $request->event_id,
            'volunteer_id' => $request->volunteer_id,
            'divisi_id' => $request->divisi_id,
            'deskripsi' => $request->deskripsi,
            'status_pendaftaran' => 'menunggu'
        ]);

        return redirect('/pendaftaran')
            ->with('success', 'Pendaftaran berhasil dikirim');
    }
}
