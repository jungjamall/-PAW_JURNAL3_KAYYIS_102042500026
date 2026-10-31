<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       // User Dosen
        $dosen = User::create([
            'name' => 'Dr. Ir. Budi Santoso, M.T.',
            'email' => 'dosen@celoe.lms',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        // User Mahasiswa
        $mahasiswa = User::create([
            'name' => 'Ahmad Raihan Arifinza',
            'email' => 'mahasiswa@celoe.lms',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        // Mata Kuliah Awal
        MataKuliah::create([
            'kode_mk' => 'CSG2A3',
            'nama_mk' => 'Pengembangan Aplikasi Website',
            'deskripsi' => 'Mempelajari dasar hingga lanjut pemrosesan web dengan Laravel.',
            'sks' => 3,
            'dosen_id' => $dosen->id,
        ]);
    }
}