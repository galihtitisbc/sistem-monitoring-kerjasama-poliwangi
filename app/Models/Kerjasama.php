<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kerjasama';
    protected $guarded = ['id_kerjasama'];
    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'kerjasama_prodis', 'id_kerjasama', 'id_prodi');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
