<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Satker;
use App\Models\SubSatker;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan Daftar Pegawai
     */
    public function index()
    {
        // Eager loading relasi subSatker dan bapaknya (satker)
        $users = User::with('subSatker.satker')->latest()->get();

        // Ambil data Satker untuk dropdown di modal tambah
        $satkers = Satker::all();

        return view('admin.users.index', compact('users', 'satkers'));
    }

    /**
     * Simpan Pegawai Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'current_satker_id' => 'required',
            'current_sub_satker_id' => 'required',
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash biar aman gess
            'current_sub_satker_id' => $request->current_sub_satker_id, // Simpan penempatan kerja
            'current_satker_id' => $request->current_satker_id,
            'role' => $request->role, // Default role jika diperlukan
        ]);

        $newUser->profile()->create([
            'nip_nrp' => '-',
            'pangkat' => '-',
            'jabatan' => '-',
            'no_hp'   => '-',
            'alamat'  => '-',
        ]);

        return redirect()->back()->with('success', 'Pegawai baru berhasil didaftarkan!');
    }

    /**
     * Hapus Pegawai
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data pegawai berhasil dihapus!');
    }


    /**
     * Edit Pegawai
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'current_satker_id' => 'required',
            'current_sub_satker_id' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role,
            'current_satker_id' => $request->current_satker_id,
            'current_sub_satker_id' => $request->current_sub_satker_id,
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil diupdate/dimutasi!');
    }

    public function exportPdf($id)
    {
        $user = User::with(['profile', 'subSatker.satker'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.users.pdf_detail', compact('user'));

        // Download otomatis dengan nama file sesuai nama user
        return $pdf->download('Biodata_' . $user->name . '.pdf');
    }
}
