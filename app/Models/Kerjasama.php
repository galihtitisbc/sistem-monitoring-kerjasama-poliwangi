<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerjasama extends Model
{
    use HasFactory, SoftDeletes;
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
