<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}