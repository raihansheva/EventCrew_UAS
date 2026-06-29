<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\KategoriEvent;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('kategori')->latest()->get();
        $kategoris = KategoriEvent::all();
        return view('admin.event', compact('events', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event'      => 'required|string|max:255',
            'kategori_id'     => 'required',
            'deskripsi'       => 'nullable|string',
            'lokasi'          => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date',
            'poster'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status_event'    => 'required',
        ]);

        $posterPath = $request->file('poster')->store('posters', 'public');

        Event::create([
            'panitia_id'        => auth()->id(),
            'kategori_id'       => $request->kategori_id,
            'nama_event'        => $request->nama_event,
            'deskripsi'         => $request->deskripsi,
            'lokasi'            => $request->lokasi,
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'poster'            => $posterPath,
            'status_event'      => $request->status_event,
            'status_verifikasi' => 'menunggu',
        ]);

        return redirect('/data-event')->with('success', 'Event berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'nama_event'      => 'required|string|max:255',
            'kategori_id'     => 'required',
            'deskripsi'       => 'nullable|string',
            'lokasi'          => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status_event'    => 'required',
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $event->poster = $posterPath;
        }

        $event->update([
            'kategori_id'     => $request->kategori_id,
            'nama_event'      => $request->nama_event,
            'deskripsi'       => $request->deskripsi,
            'lokasi'          => $request->lokasi,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status_event'    => $request->status_event,
        ]);

        return redirect('/data-event')->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect('/data-event')->with('success', 'Event berhasil dihapus!');
    }
}