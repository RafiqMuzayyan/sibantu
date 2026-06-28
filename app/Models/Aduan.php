<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $table = 'data_aduan';
    protected $fillable = [
        'judul', 
        'deskripsi', 
        'jenis_aduan', 
        'lokasi', 
        'latitude',
        'longitude', 
        'status', 
        'user_id',
        'bukti',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bukti()
    {
        return $this->hasMany(BuktiAduan::class);
    }
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
