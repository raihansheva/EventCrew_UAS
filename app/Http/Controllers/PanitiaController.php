<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiVolunteer;
use App\Models\Event;
use App\Models\PendaftaranVolunteer;
use App\Models\PenugasanVolunteer;
use App\Models\Penyelenggara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function storeEvaluasi(Request $request)
    {
        $request->validate([
            'penugasan_id' => 'required|exists:penugasan_volunteers,id',
            'nilai' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);
        $cek = EvaluasiVolunteer::where(
            'penugasan_id',
            $request->penugasan_id
        )->exists();
        if ($cek) {
            return back()->with(
                'error',
                'Volunteer sudah pernah dievaluasi.'
            );
        }
        EvaluasiVolunteer::create([
            'penugasan_id' => $request->penugasan_id,
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);
        return back()->with(
            'success',
            'Evaluasi berhasil disimpan.'
        );
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

    public function profile()
    {
        $admin = Auth::user();

        $totalEvent = Event::count();

        $totalVolunteer = PendaftaranVolunteer::where('status_pendaftaran', 'diterima')->count();

        $totalPenugasan = PenugasanVolunteer::count();

        $totalEvaluasi = EvaluasiVolunteer::count();

        return view('admin.profile', compact(
            'admin',
            'totalEvent',
            'totalVolunteer',
            'totalPenugasan',
            'totalEvaluasi'
        ));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
        ]);

        $admin = Auth::user();
        
        $admin->update([
            'email' => $request->email,
        ]);

        $admin->penyelenggara->update([
            'nama_penanggung_jawab' => $request->name,
        ]);

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
