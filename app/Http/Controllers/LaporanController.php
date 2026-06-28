<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    private function filterAduan(Request $request)
    {
        $query = Aduan::with('user');

        if (
            $request->filled('tanggal_mulai') &&
            $request->filled('tanggal_selesai')
        ) {
            $query->whereBetween(
                'created_at',
                [
                    Carbon::parse($request->tanggal_mulai)->startOfDay(),
                    Carbon::parse($request->tanggal_selesai)->endOfDay(),
                ]
            );
        }

        if (
            $request->filled('kategori') &&
            $request->kategori !== 'semua'
        ) {
            $query->where(
                'jenis_aduan',
                $request->kategori
            );
        }

        if (
            $request->filled('status') &&
            $request->status !== 'semua'
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        return $query;
    }
    private function statistik($aduan)
    {
        return [
            'total_aduan' => $aduan->count(),

            'pending' => $aduan
                ->where('status', 'pending')
                ->count(),

            'diproses' => $aduan
                ->where('status', 'diproses')
                ->count(),

            'selesai' => $aduan
                ->where('status', 'selesai')
                ->count(),

            'ditolak' => $aduan
                ->where('status', 'ditolak')
                ->count(),
        ];
    }
    public function index(Request $request)
    {
        
        
        $aduan = $this
            ->filterAduan($request)
            ->latest()
            ->get();

        $statistik = $this->statistik($aduan);

        $labels = [
            'Sembako',
            'Hunian Sementara',
            'Pakaian'
        ];

        $values = [
            $aduan->where('jenis_aduan', 'sembako')->count(),
            $aduan->where('jenis_aduan', 'hunian sementara')->count(),
            $aduan->where('jenis_aduan', 'pakaian')->count(),
        ];

        return view('dashboard.laporan', [
            'data_aduan' => $aduan,
            ...$statistik,
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|max:255',
            'deskripsi_laporan' => 'nullable|max:1000',
        ]);

        $data_aduan = $this
            ->filterAduan($request)
            ->latest()
            ->get();

        $statistik = $this->statistik($data_aduan);

        $pdf = Pdf::loadView(
            'pdf.laporan',
            [
                'judul' => $request->judul_laporan,
                'deskripsi' => $request->deskripsi_laporan,

                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,

                'kategori' => $request->kategori ?? 'semua',
                'status' => $request->status ?? 'semua',

                ...$statistik,

                'chart' => $request->chart,

                'data_aduan' => $data_aduan,
            ]
        )->setPaper('a4', 'portrait');

        $namaFile =
            'laporan-' .
            now()->format('YmdHis') .
            '.pdf';

        $path =
            'laporan/' .
            $namaFile;

        Storage::disk('public')->put(
            $path,
            $pdf->output()
        );

        Laporan::create([
            'user_id' => auth()->id(),

            'judul' => $request->judul_laporan,

            'deskripsi' => $request->deskripsi_laporan,

            'file' => $path,

            'tanggal_mulai' => $request->tanggal_mulai,

            'tanggal_selesai' => $request->tanggal_selesai,

            'kategori' => $request->kategori ?? 'semua',

            'status' => $request->status ?? 'semua',

            'total_aduan' => $statistik['total_aduan'],
        ]);

        return redirect()
            ->route('data_laporan')
            ->with(
                'success',
                'Laporan berhasil dibuat'
            );;
    }
}