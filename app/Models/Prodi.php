<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_prodi';
    protected $guarded = ['id_prodi'];
    public function kerjasama()
    {
        return $this->belongsToMany(Kerjasama::class, 'kerjasama_prodis', 'id_prodi', 'id_kerjasama');
    }
}
