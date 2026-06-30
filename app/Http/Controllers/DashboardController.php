<?php

namespace App\Http\Controllers;

use App\Models\Aduan;


class DashboardController extends Controller
{
    public function index()
    {
        $query = Aduan::with('user')
            ->latest();

        $totalAduan = Aduan::count();

        $pending = Aduan::where(
            'status',
            'pending'
        )->count();

        $diproses = Aduan::where(
            'status',
            'diproses'
        )->count();

        $selesai = Aduan::where(
            'status',
            'selesai'
        )->count();

        $ditolak = Aduan::where(
            'status',
            'ditolak'
        )->count();

        $verifikasiTerbaru = Aduan::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(4)
            ->get();

        $aduanTerbaru = $query
                        ->take(10)
                        ->get();

        $values = [
            Aduan::where('jenis_aduan', 'sembako')->count(),
            Aduan::where('jenis_aduan', 'hunian sementara')->count(),
            Aduan::where('jenis_aduan', 'pakaian')->count(),
        ];
        $labels = [
            'Sembako',
            'Hunian Sementara',
            'Pakaian'
        ];
        $kategoriTerbanyak = null;

        if (!empty($values)) {

            $max = max($values);

            $index = array_search(
                $max,
                $values
            );

            $kategoriTerbanyak =
                $labels[$index];
        }

        return view('dashboard', [
            'total_aduan' => $totalAduan,
            'pending' => $pending,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,

            'verifikasi_terbaru' => $verifikasiTerbaru,
            'aduan_terbaru' => $aduanTerbaru,

            'labels' => $labels,
            'values' => $values,
            'kategori_terbanyak' => $kategoriTerbanyak,
        ]);
    }
}