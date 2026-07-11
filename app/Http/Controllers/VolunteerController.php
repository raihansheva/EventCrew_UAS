<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranVolunteer;
use App\Models\PenugasanVolunteer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = User::with('volunteer')
            ->where('role', 'volunteer')
            ->get();

        return view('admin.volunteer', compact('volunteers'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.volunteer')
            ->with('success', 'Data volunteer berhasil dihapus.');
    }

    public function dataPenugasan()
    {

        $now = Carbon::now();

        $penugasans = PenugasanVolunteer::all();

        foreach ($penugasans as $penugasan) {

            $tanggal = Carbon::parse($penugasan->tanggal_tugas);

            $jamMulai = Carbon::parse($penugasan->tanggal_tugas . ' ' . $penugasan->jam_mulai);
            $jamSelesai = Carbon::parse($penugasan->tanggal_tugas . ' ' . $penugasan->jam_selesai);

            if ($now->lt($jamMulai)) {

                $status = 'belum_dimulai';
            } elseif ($now->between($jamMulai, $jamSelesai)) {

                $status = 'berlangsung';
            } else {

                $status = 'selesai';
            }

            if ($penugasan->status_tugas != $status) {
                $penugasan->update([
                    'status_tugas' => $status
                ]);
            }
        }

        $penugasan = PendaftaranVolunteer::with(['volunteer', 'event', 'divisi', 'penugasan'])
            ->where('status_pendaftaran', 'diterima')
            ->get();

        return view('admin.penugasan', compact('penugasan'));
    }

    public function penugasan(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_volunteers,id',
            'tugas' => 'required|string',
            'lokasi_tugas' => 'required|string|max:255',
            'tanggal_mulai_tugas' => 'required|date',
            'tanggal_selesai_tugas' => 'required|date|after_or_equal:tanggal_mulai_tugas',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status_tugas' => 'required|in:belum_dimulai,berlangsung,selesai',
        ]);

        $cek = PenugasanVolunteer::where(
            'pendaftaran_id',
            $request->pendaftaran_id
        )->first();

        if ($cek) {
            return back()->with('warning', 'Volunteer ini sudah memiliki penugasan.');
        }

        PenugasanVolunteer::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'tugas' => $request->tugas,
            'lokasi_tugas' => $request->lokasi_tugas,
            'tanggal_tugas' => $request->tanggal_tugas,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_tugas' => 'berlangsung',
        ]);

        return back()->with('success', 'Penugasan berhasil ditambahkan.');
    }

    public function updatePenugasan(Request $request, $id)
    {
        $request->validate([
            'tugas' => 'required|string',
            'lokasi_tugas' => 'required|string|max:255',
            'tanggal_mulai_tugas' => 'required|date',
            'tanggal_selesai_tugas' => 'required|date|after_or_equal:tanggal_mulai_tugas',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status_tugas' => 'required|in:belum_dimulai,berlangsung,selesai',
        ]);

        $penugasan = PenugasanVolunteer::findOrFail($id);

        $penugasan->update([
            'tugas' => $request->tugas,
            'lokasi_tugas' => $request->lokasi_tugas,
            'tanggal_mulai_tugas' => $request->tanggal_mulai_tugas,
            'tanggal_selesai_tugas' => $request->tanggal_selesai_tugas,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_tugas' => $request->status_tugas,
        ]);

        return back()->with('success', 'Penugasan berhasil diperbarui.');
    }

    public function editPenugasan(Request $request, $id)
    {

        // dd($request);

        // $request->validate([
        //     'tugas'          => 'required|string',
        //     'lokasi_tugas'   => 'required|string|max:255',
        //     'tanggal_tugas'  => 'required|date',
        //     'jam_mulai'      => 'required',
        //     'jam_selesai'    => 'required|after:jam_mulai',
        // ]);

        $penugasan = PenugasanVolunteer::findOrFail($id);

        $penugasan->update([
            'tugas'         => $request->tugas,
            'lokasi_tugas'  => $request->lokasi_tugas,
            'tanggal_tugas' => $request->tanggal_tugas,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
        ]);

        return back()->with('success', 'Penugasan berhasil diperbarui.');
    }
}
