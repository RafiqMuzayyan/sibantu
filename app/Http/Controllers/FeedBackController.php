<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(
        Request $request,
        Aduan $aduan
    ) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|max:1000',
        ]);

        if ($aduan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($aduan->status !== 'selesai') {
            return back()->with(
                'error',
                'Feedback hanya dapat diberikan pada aduan yang telah selesai.'
            );
        }

        if ($aduan->feedback) {
            return back()->with(
                'error',
                'Feedback sudah pernah diberikan.'
            );
        }

        Feedback::create([
            'aduan_id' => $aduan->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with(
            'success',
            'Terima kasih atas feedback yang diberikan.'
        );
    }
}