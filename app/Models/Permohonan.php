<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_permohonan';
    protected $guarded = ['id_permohonan'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'permohonan_prodis', 'id_permohonan', 'id_prodi');
    }
}
