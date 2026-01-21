<?php

namespace App\Http\Controllers\Personel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with(['profile', 'subSatker.satker'])->findOrFail(Auth::id());
        return view('personel.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */ //
        $user = Auth::user();

        // Validasi input sesuai field di model Profile
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'nip_nrp' => 'nullable|string|max:50',
            'pangkat' => 'nullable|string|max:100',
            'jabatan' => 'nullable|string|max:100',
            'no_hp'   => 'nullable|string|max:20',
            'alamat'  => 'nullable|string',
            'foto_personel' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 1. Update tabel Users
        $userData = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Cek kalau user isi password baru
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $user->update($userData);

        // 2. Siapkan data untuk tabel Profiles
        $profileData = [
            'nip_nrp' => $request->nip_nrp,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'no_hp'   => $request->no_hp,
            'alamat'  => $request->alamat,
        ];

        // 3. Logic Upload Foto Personel
        if ($request->hasFile('foto_personel')) {
            $file = $request->file('foto_personel');

            // Gunakan ini untuk memastikan nama file bersih dari spasi (penting di Windows)
            $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();

            // Pastikan folder tujuan ada atau Laravel punya izin tulis
            $path = $file->storeAs('foto_personel', $fileName, 'public');

            if ($path) {
                // Hapus foto lama hanya jika upload baru sukses
                if ($user->profile && $user->profile->foto_personel) {
                    Storage::delete('public/foto_personel/' . $user->profile->foto_personel);
                }
                $profileData['foto_personel'] = $fileName;
            }
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->back()->with('success', 'Profil dan Biodata berhasil diperbarui gess!');
    }
}
