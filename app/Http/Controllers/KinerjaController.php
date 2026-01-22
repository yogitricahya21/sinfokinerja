<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\SubSatker;
use Illuminate\Http\Request;
use App\Models\KinerjaEvidence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KinerjaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil riwayat laporan (Eager Loading agar ringan)
        $query = KinerjaEvidence::with(['user', 'kegiatan.subSatker', 'users'])->latest();

        if ($user->role == 'personel') {
            $evidences = $query->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
            })->get();

            // Data untuk Form Input
            $subSatkers = SubSatker::where('satker_id', $user->current_satker_id)->get();
            $allPersonel = User::where('role', 'personel')->where('id', '!=', $user->id)->get();
        } else {
            $evidences = $query->get();
            $subSatkers = SubSatker::all();
            $allPersonel = User::where('role', 'personel')->get();
        }

        return view('kinerja.index', compact('evidences', 'subSatkers', 'allPersonel'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Gabungan (Kegiatan + Evidence)
        $request->validate([
            'sub_satker_id'   => 'required|exists:sub_satkers,id',
            'judul_kegiatan'  => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'status'          => 'required|in:progres,selesai,pending',
            'foto_kegiatan'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan'         => 'required|string',
            'anggota_ids'     => 'nullable|array',
        ]);

        // Gunakan Database Transaction agar data aman
        DB::beginTransaction();

        try {
            // 2. Buat Data Kegiatan Utama
            $kegiatan = Kegiatan::create([
                'judul_kegiatan' => $request->judul_kegiatan,
                'deskripsi'      => $request->deskripsi,
                'satker_id'      => Auth::user()->current_satker_id,
                'sub_satker_id'  => $request->sub_satker_id,
                'status'         => $request->status,
                'created_by'     => Auth::id(),
            ]);

            // 3. Proses Upload Foto
            $path = $request->file('foto_kegiatan')->store('evidence_kegiatan', 'public');

            // 4. Buat Data Evidence (Laporan Pertama)
            $evidence = KinerjaEvidence::create([
                'kegiatan_id'   => $kegiatan->id,
                'user_id'       => Auth::id(),
                'foto_kegiatan' => $path,
                'catatan'       => $request->catatan,
            ]);

            // 5. Simpan Anggota Kelompok ke Tabel Pivot (Fitur Kerja Kelompok)
            $anggota = $request->input('anggota_ids', []);
            // Penginput otomatis jadi anggota juga
            $semuaPeserta = array_unique(array_merge([Auth::id()], $anggota));

            $evidence->users()->sync($semuaPeserta);

            DB::commit();
            return redirect()->back()->with('success', 'Laporan dan Kegiatan berhasil dibuat, gess!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Waduh gagal gess: ' . $e->getMessage());
        }
    }
}
