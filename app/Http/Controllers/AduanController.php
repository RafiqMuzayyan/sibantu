<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AduanController extends Controller
{
    public function create()
    {
        return view('home.modif_aduan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:100',
            'deskripsi' => 'required',
            'jenis_aduan' => 'required',
            'lokasi' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'bukti' => 'nullable|array|max:3',
            'bukti.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120'

        ],
        [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul Terlalu Panjang',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'jenis_aduan.required' => 'Jenis aduan wajib dipilih.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            
        ]);


        $aduan = Aduan::create([
            'user_id' => Auth::id(),

            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'jenis_aduan' => $validated['jenis_aduan'],
            'lokasi' => $validated['lokasi'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        if ($request->hasFile('bukti')) {

        foreach ($request->file('bukti') as $file) {

            $path = $file->store('bukti', 'public');

            $aduan->bukti()->create([
                'file' => $path,
                'nama_asli' => $file->getClientOriginalName()
            ]);
        }
    }

        return redirect()
            ->route('riwayat')
            ->with('success', 'Aduan berhasil dikirim.');
        
            
    }

   public function riwayat(Request $request)
    {
        $query = Auth::user()
            ->data_aduan()
            ->latest();

        if ($request->filled('search')) {
            $query->where(
                'judul',
                'like',
                '%' . $request->search . '%'
            );
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

        $data_aduan = $query->paginate(10);

        return view('home.riwayat', compact('data_aduan'));
    }

    public function show(int $id)
    {
        $user = Auth::user();
        $aduan = $user
            ->data_aduan()
            ->with('feedback')
            ->findOrFail($id);

        return view('home.aduan_ku', [
            'aduan' => $aduan
        ]);
    }

    public function edit(int $id)
    {
        $aduan = Auth::user()
            ->data_aduan()
            ->with('bukti')
            ->where('status', 'pending')
            ->findOrFail($id);

        return view('home.modif_aduan', [
            'aduan' => $aduan
        ]);
    }
    public function update(Request $request, int $id)
    {
        $aduan = Auth::user()
            ->data_aduan()
            ->where('status', 'pending')
            ->findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
            'jenis_aduan' => 'required',
            'lokasi' => 'required',

            'bukti' => 'nullable|array|max:3',
            'bukti.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $aduan->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'jenis_aduan' => $validated['jenis_aduan'],
            'lokasi' => $validated['lokasi'],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $jumlahLama = $aduan->bukti()->count();

        $jumlahDihapus = count($request->hapus_bukti ?? []);

        $jumlahBaru = count($request->file('bukti') ?? []);

        $totalAkhir =
            $jumlahLama
            - $jumlahDihapus
            + $jumlahBaru;

        if ($totalAkhir > 3) {
            return back()
                ->withErrors([
                    'bukti' => 'Maksimal 3 bukti.'
                ])
                ->withInput();
        }

        if ($request->filled('hapus_bukti')) {

            foreach ($request->hapus_bukti as $id) {

                $bukti = $aduan
                    ->bukti()
                    ->where('id', $id)
                    ->first();

                if ($bukti) {

                    Storage::disk('public')->delete($bukti->file);

                    $bukti->delete();
                }
            }
        }

        if ($request->hasFile('bukti')) {

            foreach ($request->file('bukti') as $file) {

                $path = $file->store('bukti', 'public');

                $aduan->bukti()->create([
                    'file' => $path,
                    'nama_asli' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('aduan_ku', $aduan->id)
            ->with('success', 'Aduan berhasil diperbarui.');
    }
    public function destroy(int $id)
    {
        $aduan = auth()->user()
            ->data_aduan()
            ->where('status', 'pending')
            ->findOrFail($id);

        foreach ($aduan->bukti as $bukti) {

            Storage::disk('public')->delete($bukti->file);

        }

        $aduan->delete();

        return redirect()
            ->route('riwayat')
            ->with(
                'success',
                'Aduan berhasil dihapus.'
            );
    }
}
