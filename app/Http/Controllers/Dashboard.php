<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\PendaftaranVolunteer;
use App\Models\PenugasanVolunteer;
use App\Models\Penyelenggara;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return $this->dashboardAdmin();
        }

        if (Auth::user()->role == 'panitia') {
            return $this->dashboardPanitia();
        }

        abort(403);
    }

    private function dashboardPanitia()
{
    $panitia = Penyelenggara::where('user_id', Auth::id())->firstOrFail();

    // Event milik panitia
    $totalEvent = Event::where('panitia_id', $panitia->user_id)->count();

    // Pendaftaran pada event milik panitia
    $totalPendaftaran = PendaftaranVolunteer::whereHas('event', function ($q) use ($panitia) {
        $q->where('panitia_id', $panitia->user_id);
    })->count();

    // Penugasan pada event milik panitia
    $totalPenugasan = PenugasanVolunteer::whereHas('pendaftaran.event', function ($q) use ($panitia) {
        $q->where('panitia_id', $panitia->user_id);
    })->count();

    $eventTerbaru = Event::where('panitia_id', $panitia->user_id)
        ->latest()
        ->take(5)
        ->get();

    $pendaftaranTerbaru = PendaftaranVolunteer::with([
        'volunteer',
        'event',
        'divisi'
    ])
    ->whereHas('event', function ($q) use ($panitia) {
        $q->where('panitia_id', $panitia->user_id);
    })
    ->latest()
    ->take(5)
    ->get();

    $penugasanAktif = PenugasanVolunteer::with([
        'pendaftaran.volunteer',
        'pendaftaran.event',
        'pendaftaran.divisi',
    ])
    ->where('status_tugas', 'berlangsung')
    ->whereHas('pendaftaran.event', function ($q) use ($panitia) {
        $q->where('panitia_id', $panitia->user_id);
    })
    ->latest()
    ->take(5)
    ->get();

    return view('admin.dashboard', compact(
        'totalEvent',
        'totalPendaftaran',
        'totalPenugasan',
        'eventTerbaru',
        'pendaftaranTerbaru',
        'penugasanAktif'
    ));
}

    private function dashboardAdmin()
    {
        $totalVolunteer   = Volunteer::count();
        $totalEvent       = Event::count();
        $totalPendaftaran = PendaftaranVolunteer::count();
        $totalPenugasan   = PenugasanVolunteer::count();

        $eventTerbaru = Event::with('panitia')
            ->latest()
            ->take(5)
            ->get();

        $eventMenunggu = Event::with('panitia')
            ->where('status_verifikasi', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        $pendaftaranTerbaru = PendaftaranVolunteer::with([
            'volunteer',
            'event',
            'divisi'
        ])->latest()->take(5)->get();

        $penugasanAktif = PenugasanVolunteer::with([
            'volunteer',
            'event',
            'divisi'
        ])
            ->where('status_tugas', 'berlangsung')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVolunteer',
            'totalEvent',
            'totalPendaftaran',
            'totalPenugasan',
            'eventTerbaru',
            'eventMenunggu',
            'pendaftaranTerbaru',
            'penugasanAktif'
        ));
    }
}
