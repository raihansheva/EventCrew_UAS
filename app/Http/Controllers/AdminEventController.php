<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\KategoriEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        // $request->validate([
        //     'nama_event'      => 'required|string|max:255',
        //     'kategori_id'     => 'required',
        //     'deskripsi'       => 'nullable|string',
        //     'lokasi'          => 'required|string|max:255',
        //     'tanggal_mulai'   => 'required|date',
        //     'tanggal_selesai' => 'required|date',
        //     'poster'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        //     'status_event'    => 'required',
        // ]);
        // dd($request->all());

        $file = $request->file('poster');

        $fileName = Str::slug($request->nama_event) . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('uploads/posters', $fileName, 'public');

        $posterPath = 'uploads/posters/' . $fileName;

        Event::create([
            'panitia_id'        => Auth::id(),
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

    public function verifikasi(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // dd($request->alasan_penolakan);

        if ($request->status_verifikasi == 'ditolak') {

            $request->validate([
                'alasan_penolakan' => 'required|string|max:500',
            ]);

            $event->status_verifikasi = 'ditolak';
            $event->alasan_penolakan = $request->alasan_penolakan;
        } else {

            $event->status_verifikasi = 'disetujui';
            $event->alasan_penolakan = null;
        }

        $event->save();

        return back()->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
