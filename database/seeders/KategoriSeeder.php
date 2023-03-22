<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_kategori' =>  'Luar Negeri'
            ], [
                'nama_kategori' =>  'Instansi Pemerintah'
            ], [
                'nama_kategori' =>  'BUMN'
            ], [
                'nama_kategori' =>  'Perguruan Tinggi'
            ], [
                'nama_kategori' =>  'Industri, Masyarakat dan PKL'
            ]
        ];
        Kategori::insert($data);
    }
}
