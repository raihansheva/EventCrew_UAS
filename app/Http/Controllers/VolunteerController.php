<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiVolunteer;
use App\Models\PendaftaranVolunteer;
use App\Models\PenugasanVolunteer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = User::with('volunteer')
            ->where('role', 'volunteer')
            ->get();

        return view('admin.volunteer', compact('volunteers'));
    }

    public function profile()
    {
        $profile = User::with('volunteer')
            ->findOrFail(Auth::id());

        // Pastikan user memiliki data volunteer
        if (!$profile->volunteer) {
            abort(404, 'Data volunteer tidak ditemukan.');
        }

        $volunteerId = $profile->volunteer->id;

        $penugasanId = PenugasanVolunteer::whereHas('pendaftaran', function ($query) use ($volunteerId) {
            $query->where('volunteer_id', $volunteerId);
        })->pluck('id');

        $evaluasi = EvaluasiVolunteer::whereIn('penugasan_id', $penugasanId)->get();

        $totalPendaftaran = PendaftaranVolunteer::where('volunteer_id', $volunteerId)->count();

        $totalDiterima = PendaftaranVolunteer::where('volunteer_id', $volunteerId)
            ->where('status_pendaftaran', 'diterima')
            ->count();

        $totalMenunggu = PendaftaranVolunteer::where('volunteer_id', $volunteerId)
            ->where('status_pendaftaran', 'menunggu')
            ->count();

        $totalDitolak = PendaftaranVolunteer::where('volunteer_id', $volunteerId)
            ->where('status_pendaftaran', 'ditolak')
            ->count();

        return view('pages.profile', compact(
            'profile',
            'totalPendaftaran',
            'totalDiterima',
            'totalMenunggu',
            'totalDitolak',
            'evaluasi'
        ));
    }

    public function editProfile(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'pendidikan'     => 'nullable|string|max:255',
            'keahlian'       => 'nullable|string|max:255',
            'pengalaman'     => 'nullable|string|max:255',
        ]);

        $user = User::with('volunteer')->findOrFail($id);

        $user->update([
            'email' => $request->email
        ]);

        $user->volunteer->update([
            'nama_lengkap'   => $request->nama_lengkap,
            'no_hp'          => $request->no_hp,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'pendidikan'     => $request->pendidikan,
            'keahlian'       => $request->keahlian,
            'pengalaman'     => $request->pengalaman,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.'
            ]);
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function pendaftaranSaya()
    {
        $volunteer = Auth::user()->volunteer;

        $pendaftaran = PendaftaranVolunteer::with([
            'event',
            'divisi'
        ])
            ->where('volunteer_id', $volunteer->id)
            ->latest()
            ->get();

        return view('pages.singlePendaftaran', compact('pendaftaran'));
    }

    public function penugasanSaya()
    {
        $volunteer = Auth::user()->volunteer;

        $penugasan = PenugasanVolunteer::with([
            'pendaftaran.event',
            'pendaftaran.divisi'
        ])
            ->whereHas('pendaftaran', function ($query) use ($volunteer) {
                $query->where('volunteer_id', $volunteer->id);
            })
            ->latest()
            ->get();

        return view('pages.penugasan', compact('penugasan'));
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

        foreach ($penugasans as $item) {

            $jamMulai = Carbon::parse($item->tanggal_tugas . ' ' . $item->jam_mulai);
            $jamSelesai = Carbon::parse($item->tanggal_tugas . ' ' . $item->jam_selesai);
            // dd([
            //     'now' => $now->format('Y-m-d H:i:s'),
            //     'tanggal' => $item->tanggal_tugas,
            //     'jam_mulai' => $item->jam_mulai,
            //     'jam_selesai' => $item->jam_selesai,
            //     'mulai' => $jamMulai->format('Y-m-d H:i:s'),
            //     'selesai' => $jamSelesai->format('Y-m-d H:i:s'),
            // ]);
            if ($now->lt($jamMulai)) {

                $status = 'belum_dimulai';
            } elseif ($now->gte($jamMulai) && $now->lte($jamSelesai)) {

                $status = 'berlangsung';
            } else {

                $status = 'selesai';
            }

            if ($item->status_tugas !== $status) {
                $item->update([
                    'status_tugas' => $status
                ]);
            }
        }

        $penugasan = PendaftaranVolunteer::with([
            'volunteer',
            'event',
            'divisi',
            'penugasan.evaluasi'
        ])
            ->where('status_pendaftaran', 'diterima')
            ->get();

        return view('admin.penugasan', compact('penugasan'));
    }

    public function penugasan(Request $request)
    {
        // $request->validate([
        //     'pendaftaran_id' => 'required|exists:pendaftaran_volunteers,id',
        //     'tugas' => 'required|string',
        //     'lokasi_tugas' => 'required|string|max:255',
        //     'tanggal_mulai_tugas' => 'required|date',
        //     'tanggal_selesai_tugas' => 'required|date|after_or_equal:tanggal_mulai_tugas',
        //     'jam_mulai' => 'required',
        //     'jam_selesai' => 'required|after:jam_mulai',
        //     'status_tugas' => 'required|in:belum_dimulai,berlangsung,selesai',
        // ]);

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
