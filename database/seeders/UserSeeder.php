<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Satker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Satker Contoh
        $satker = Satker::create([
            'nama_satker' => 'Dinas Komunikasi dan Informatika',
            'kode_satker' => 'DISKOMINFO-01'
        ]);

        // 2. Buat User Admin
        User::create([
            'name' => 'Administrator Utama',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 3. Buat User Kadis
        User::create([
            'name' => 'Kepala Dinas',
            'email' => 'kadis@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'kadis',
            'current_satker_id' => $satker->id,
        ]);

        // 4. Buat User Personel
        User::create([
            'name' => 'Yogi Personel',
            'email' => 'personel@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'personel',
            'current_satker_id' => $satker->id,
        ]);
    }
}
