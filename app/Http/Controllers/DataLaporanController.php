<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataLaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with('user');

        if ($request->filled('search')) {
            $query->where(
                'judul',
                'like',
                '%' . $request->search . '%'
            );
        }

        $data_laporan = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'dashboard.data_laporan',
            compact('data_laporan')
        );
    }

   
    public function destroy(Laporan $laporan)
    {
        Storage::disk('public')->delete(
            $laporan->file
        );

        $laporan->delete();

        return redirect()
            ->route('data_laporan')
            ->with(
                'success',
                'Laporan berhasil dihapus.'
            );
    }
}