<?php

namespace App\Http\Controllers;

use App\Http\Requests\TambahKerjasamaRequest;
use App\Models\Kategori;
use App\Models\Kerjasama;
use App\Models\Permohonan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
    public function index()
    {
        return view('admin.kerjasama.lihatDataKerjasama', [
            'title'     =>  'Daftar Kerjasama',
            'kerjasama' =>  Kerjasama::with('kategori')->get()
        ]);
    }
    public function tambahDataKerjasama()
    {
        return view('admin.kerjasama.tambah-kerjasama', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'title'     => 'Tambah Data Kerjasama'
        ]);
    }
    public function store(TambahKerjasamaRequest $request)
    {
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        try {
            $fileMou->storeAs('public/file-mou', $validated['nomor_mou'] . "." . $fileMou->getClientOriginalExtension());
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            // if (Auth::user()->role == "admin") {
            //     $validated['status'] = "Diterima";
            // }
            $permohonan = Kerjasama::create($validated);
            $permohonan->prodi()->attach($validated['prodi']);
            return redirect('/tambah-kerja-sama')->with('success', 'Berhasil Menambahkan Data Kerjasama');
        } catch (\Throwable $e) {
            return redirect('/tambah-kerja-sama')->with('error', 'Gagal Menambahkan Data Kerjasama');
        }
    }
    public function download($nomor_mou)
    {
        if (Storage::exists('public/file-mou/' . $nomor_mou . '.pdf')) {
            return Storage::download('public/file-mou/' . $nomor_mou . '.pdf');
        } elseif (Storage::exists('public/file-mou/' . $nomor_mou . '.docx')) {
            return Storage::download('public/file-mou/' . $nomor_mou . '.docx');
        } else {
            return redirect('/data-kerjasama')->with('error', 'Gagal Download File Mou, File Tidak Ada');
        }
    }
}
