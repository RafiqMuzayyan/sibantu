<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('home', [
            'total_aduan' => $user->data_aduan()->count(),

            'pending' => $user->data_aduan()
                ->where('status', 'pending')
                ->count(),

            'selesai' => $user->data_aduan()
                ->where('status', 'selesai')
                ->count(),

            'ditolak' => $user->data_aduan()
                ->where('status', 'ditolak')
                ->count(),

            'progress' => $user->data_aduan()
                ->where('status', 'diproses')
                ->latest()
                ->take(4)
                ->get(),
        ]);
    }
}
