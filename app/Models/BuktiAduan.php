<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiAduan extends Model
{
    protected $table = 'data_bukti_aduan';
    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }
    protected $fillable = [
        'aduan_id',
        'file',
        'nama_asli'
    ];

}
