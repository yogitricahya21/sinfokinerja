<!DOCTYPE html>
<html>
<head>
    <title>Laporan Biodata Personel</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .foto { width: 120px; height: 150px; object-fit: cover; margin-top: 20px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN BIODATA PERSONEL</h2>
        <h3>SinfoKinerja - {{ date('Y') }}</h3>
    </div>

    <div style="text-align: center;">
        @if($user->profile && $user->profile->foto_personel)
            {{-- Menggunakan path asli untuk DomPDF --}}
            <img src="{{ public_path('storage/foto_personel/' . $user->profile->foto_personel) }}" class="foto">
        @endif
    </div>

    <table>
        <tr><th>Nama Lengkap</th><td>: {{ $user->name }}</td></tr>
        <tr><th>NIP / NRP</th><td>: {{ $user->profile->nip_nrp ?? '-' }}</td></tr>
        <tr><th>Pangkat / Jabatan</th><td>: {{ ($user->profile->pangkat ?? '-') . ' / ' . ($user->profile->jabatan ?? '-') }}</td></tr>
        <tr><th>Satker</th><td>: {{ $user->subSatker->satker->nama_satker ?? '-' }}</td></tr>
        <tr><th>No. WhatsApp</th><td>: {{ $user->profile->no_hp ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>: {{ $user->profile->alamat ?? '-' }}</td></tr>
    </table>
</body>
</html>