<?php

namespace App\Http\Trait;

use App\Models\Kategori;
use App\Models\Prodi;

trait TambahKategoriDanProdi
{
    public function tambahKategori($kategori)
    {
        try {
            return Kategori::create([
                'nama_kategori' =>  $kategori
            ])->id_kategori;
        } catch (\Throwable $e) {
            return redirect('/tambah-kerja-sama')->with('error', 'Gagal Menambahkan Kategori');
        }
    }
    public function tambahProdi($prodi)
    {
        try {
            return Prodi::create([
                'nama_prodi'    =>  $prodi
            ])->id_prodi;
        } catch (\Throwable $e) {
            return redirect('/tambah-kerja-sama')->with('error', 'Gagal Menambahkan Prodi');
        }
    }
}
