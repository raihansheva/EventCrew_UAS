<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\PendaftaranVolunteer;
use App\Models\PenugasanVolunteer;
use App\Models\Penyelenggara;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Card Statistik
        $totalVolunteer   = Volunteer::count();
        $totalEvent       = Event::count();
        $totalPendaftaran = PendaftaranVolunteer::count();
        $totalPenugasan   = PenugasanVolunteer::count();

        // Event Terbaru
        $eventTerbaru = Event::with('panitia')
            ->latest()
            ->take(5)
            ->get();

        // Event Menunggu Verifikasi
        $eventMenunggu = Event::with('panitia')
            ->where('status_verifikasi', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        // Pendaftaran Terbaru
        $pendaftaranTerbaru = PendaftaranVolunteer::with([
            'volunteer',
            'event',
            'divisi'
        ])
            ->latest()
            ->take(5)
            ->get();

        // Penugasan Aktif
        $penugasanAktif = PenugasanVolunteer::with([
            'volunteer',
            'event',
            'divisi'
        ])
            ->where('status_tugas', 'berjalan')
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
