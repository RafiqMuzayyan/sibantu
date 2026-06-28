<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'data_laporan';
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'file',
        'tanggal_mulai',
        'tanggal_selesai',
        'kategori',
        'status',
        'total_aduan',
    ];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
