<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'masyarakat')
            ->withCount('data_aduan');
        
        $sort = $request->input('sort', 'desc');

        $query->orderBy(
            'created_at',
            $sort
        );

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'nik',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        $data_masyarakat = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'dashboard.masyarakat',
            compact('data_masyarakat')
        );
    }
}