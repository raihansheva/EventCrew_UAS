<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use Illuminate\Http\Request;

class KategoriEventController extends Controller
{
    public function index()
    {
        $kategoris = KategoriEvent::latest()->get();

        return view('admin.eventKategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        KategoriEvent::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->back()
    ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:255',
        ]);

        $kategori = KategoriEvent::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

    return redirect()->back()
    ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = KategoriEvent::findOrFail($id);

        $kategori->delete();

        return redirect()->back()
    ->with('success', 'Kategori berhasil dihapus.');
    }
}