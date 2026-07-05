<?php

namespace App\Http\Controllers;

use App\Models\Penyelenggara;
use Illuminate\Http\Request;

class PanitiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $panitia = Penyelenggara::with('user')->get();
        return view('admin.panitia', compact('panitia'));
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
        $penyelenggara = Penyelenggara::findOrFail($id);

        $penyelenggara->update([
            'nama_penyelenggara'    => $request->nama_penyelenggara,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'no_hp'                 => $request->no_hp,
            'alamat'                => $request->alamat,
            'deskripsi'             => $request->deskripsi,
        ]);

        return redirect()->back()
            ->with('success', 'Data penyelenggara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(string $id)
    {
        $penyelenggara = Penyelenggara::findOrFail($id);
        $user = $penyelenggara->user;
        $penyelenggara->delete();
        if ($user) {
            $user->delete();
        }
        return redirect()->back()
            ->with('success', 'Penyelenggara berhasil dihapus.');
    }

    public function verifikasi(Request $request, string $id)
    {
        $penyelenggara = Penyelenggara::findOrFail($id);
        $penyelenggara->update([
            'status_verifikasi' => $request->status_verifikasi,
        ]);
        return redirect()->back()
            ->with('success', 'Status penyelenggara berhasil diperbarui.');
    }
}
