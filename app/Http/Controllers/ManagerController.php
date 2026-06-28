<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboard(Request $request)
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

        $total_laporan = Laporan::count();

        return view(
            'manager',
            compact(
                'data_laporan',
                'total_laporan'
            )
        );
    }
}