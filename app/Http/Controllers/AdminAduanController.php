<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aduan::with('user')
            ->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {

                $q->where(
                    'judul',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhereHas('user', function ($user) use ($request) {

                    $user->where(
                        'nama',
                        'like',
                        '%' . $request->search . '%'
                    );

                });

            });
        }

        if ($request->filled('kategori')) {

            $query->where(
                'jenis_aduan',
                $request->kategori
            );
        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $dataAduan = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'dashboard.data_aduan',
            [
                'data_aduan' => $dataAduan
            ]
        );
    }
    public function show(Aduan $aduan)
    {
        $aduan->load([
            'user',
            'bukti',
            'feedback'
        ]);

        return view(
            'dashboard.aduan',
            compact('aduan')
        );
    }
    public function updateStatus(
        Request $request,
        Aduan $aduan
    )
    {
        $request->validate([
            'status' => [
                'required',
                'in:diproses,selesai,ditolak'
            ]
        ]);

        $aduan->update([
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Status berhasil diperbarui.'
        );
    }
    public function destroy(Aduan $aduan)
    {
        foreach ($aduan->bukti as $bukti) {
            Storage::disk('public')
                ->delete($bukti->file);
        }
        $aduan->delete();
        return redirect()
            ->route('data_aduan')
            ->with(
                'success',
                'Aduan berhasil dihapus.'
            );
    }
}
