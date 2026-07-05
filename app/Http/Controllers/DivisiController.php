<?php

namespace App\Http\Controllers;

use App\Models\DivisiVolunteer;
use App\Models\Event;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisi = DivisiVolunteer::all();
        $event = Event::all();
        return view('admin.divisi', compact('divisi', 'event'));
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
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nama_divisi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kuota_volunteer' => 'required|integer|min:1',
        ], [
            'event_id.required' => 'Event wajib dipilih.',
            'event_id.exists' => 'Event tidak ditemukan.',
            'nama_divisi.required' => 'Nama divisi wajib diisi.',
            'kuota_volunteer.required' => 'Kuota volunteer wajib diisi.',
            'kuota_volunteer.integer' => 'Kuota harus berupa angka.',
            'kuota_volunteer.min' => 'Kuota minimal 1.',
        ]);

        DivisiVolunteer::create([
            'event_id' => $request->event_id,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
            'kuota_volunteer' => $request->kuota_volunteer,
        ]);

        return redirect()->back()->with('success', 'Divisi berhasil ditambahkan.');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nama_divisi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kuota_volunteer' => 'required|integer|min:1',
        ]);

        $divisi = DivisiVolunteer::findOrFail($id);

        $divisi->update([
            'event_id' => $request->event_id,
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
            'kuota_volunteer' => $request->kuota_volunteer,
        ]);

        return redirect()->back()->with('success', 'Divisi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $divisi = DivisiVolunteer::findOrFail($id);

        if ($divisi->event()->exists()) {
            return redirect()->back()
                ->with('error', 'Divisi tidak dapat dihapus karena ada event.');
        }

        $divisi->delete();

        return redirect()->back()
            ->with('success', 'Divisi berhasil dihapus.');
    }
}
