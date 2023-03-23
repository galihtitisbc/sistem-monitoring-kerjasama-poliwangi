<?php

namespace App\Http\Controllers;

use App\Http\Requests\TambahKerjasamaRequest;
use App\Models\Kategori;
use App\Models\Permohonan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KerjasamaController extends Controller
{
    public function index()
    {
        return view('admin.kerjasama.tambah-kerjasama', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all()
        ]);
    }
    public function tambahDataKerjasama(TambahKerjasamaRequest $request)
    {
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        try {
            $fileMou->storeAs('public/file-mou', $validated['nomor_mou'] . "." . $fileMou->getClientOriginalExtension());
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            $permohonan = Permohonan::create($validated);
            $permohonan->prodi()->attach($validated['prodi']);
            return redirect('/tambah-kerja-sama')->with('success', 'Berhasil Menambahkan Data Kerjasama');
        } catch (\Throwable $e) {
            return redirect('/tambah-kerja-sama')->with('error', 'Gagal Menambahkan Data Kerjasama');
        }
    }
}
