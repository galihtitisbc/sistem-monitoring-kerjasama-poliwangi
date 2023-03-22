<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Prodi;
use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function index()
    {
        return view('admin.kerjasama.tambah-kerjasama', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all()
        ]);
    }
}
