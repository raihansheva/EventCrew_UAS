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

        if (Auth::user()->role == "admin") {
            return $this->dataPendaftaranAdmin();
        }

        if (Auth::user()->role == "panitia") {
            return $this->dataPendaftaranPanitia();
        }
    }

    private function dataPendaftaranAdmin()
    {

        $pendaftaran = PendaftaranVolunteer::with(['volunteer', 'event', 'divisi'])->get();

        return view('admin.pendaftaran', compact('pendaftaran'));
    }

    private function dataPendaftaranPanitia()
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


        if ($pendaftaran->status_pendaftaran != 'menunggu') {
            return back()->with('warning', 'Pendaftaran ini sudah diverifikasi.');
        }

        if ($request->status_pendaftaran == 'diterima') {
            if ($pendaftaran->divisi->kuota_volunteer <= 0) {
                return back()->with('warning', 'Kuota volunteer pada divisi ini sudah penuh.');
            }

            $pendaftaran->divisi->decrement('kuota_volunteer');
        }

        $pendaftaran->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

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
            'event_id'      => 'required|exists:events,id',
            'volunteer_id'  => 'required|exists:volunteers,id',
            'divisi_id'     => 'required|exists:divisi_volunteers,id',
            'motivasi'      => 'nullable|string'
        ]);

        $cekPendaftaran = PendaftaranVolunteer::where('event_id', $request->event_id)
            ->where('volunteer_id', $request->volunteer_id)
            ->whereIn('status_pendaftaran', ['menunggu', 'diterima'])
            ->exists();

        if ($cekPendaftaran) {
            return back()->with(
                'error',
                'Anda sudah melakukan pendaftaran pada event ini dan masih menunggu persetujuan atau sudah diterima.'
            );
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
