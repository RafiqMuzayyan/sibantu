<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'aduan_id',
        'user_id',
        'rating',
        'komentar',
    ];
}
