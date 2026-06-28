<?php

namespace Database\Seeders;

use App\Models\Aduan;
use App\Models\User;
use Illuminate\Database\Seeder;

class AduanSeeder extends Seeder
{
    public function run(): void
    {
        $judul = [
            'Distribusi Sembako Belum Merata',
            'Permohonan Bantuan Pakaian',
            'Hunian Sementara Rusak',
            'Bantuan Belum Diterima',
            'Kekurangan Persediaan Sembako',
            'Kebutuhan Pakaian Anak',
            'Tempat Tinggal Sementara Tidak Layak',
            'Permintaan Tambahan Bantuan',
            'Bantuan Terlambat Disalurkan',
            'Kondisi Hunian Memburuk',
        ];

        $lokasi = [
            'Muara Satu, Lhokseumawe, Aceh',
            'Blang Mangat, Lhokseumawe, Aceh',
            'Banda Sakti, Lhokseumawe, Aceh',
            'Muara Dua, Lhokseumawe, Aceh',
        ];

        $users = User::where('role', 'masyarakat')->pluck('id');

        foreach (range(1, 50) as $i) {

            Aduan::create([
                'user_id' => $users->random(),

                'judul' => fake()->randomElement($judul),

                'deskripsi' =>
                    fake()->paragraphs(
                        rand(2, 4),
                        true
                    ),

                'jenis_aduan' =>
                    fake()->randomElement([
                        'sembako',
                        'hunian sementara',
                        'pakaian',
                    ]),

                'lokasi' =>
                    fake()->randomElement(
                        $lokasi
                    ),

                'latitude' =>
                    fake()->randomFloat(
                        8,
                        5.15,
                        5.22
                    ),

                'longitude' =>
                    fake()->randomFloat(
                        8,
                        97.10,
                        97.20
                    ),

                'status' =>
                    fake()->randomElement([
                        'pending',
                        'diproses',
                        'selesai',
                        'ditolak',
                    ]),
            ]);
        }
    }
}