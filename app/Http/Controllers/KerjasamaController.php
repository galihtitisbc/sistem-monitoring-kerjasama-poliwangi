<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Kategori;
use App\Models\Kerjasama;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Trait\TambahKategoriDanProdi;
use App\Http\Requests\TambahKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;

class KerjasamaController extends Controller
{
    use TambahKategoriDanProdi;
    public function index()
    {

        return view('admin.kerjasama.lihatKerjasama', [
            'title'     =>  'Daftar Kerjasama',
            'kerjasama' =>  Kerjasama::with('kategori')->orderBy('id_kerjasama', 'DESC')->paginate(5),
        ]);
    }
    public function tambahDataKerjasama()
    {
        return view('admin.kerjasama.tambahKerjasama', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'title'     => 'Tambah Data Kerjasama'
        ]);
    }
    public function store(TambahKerjasamaRequest $request)
    {
        // dd($request);
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        foreach ($validated['prodi'] as $value) {
            if (is_numeric($value) != 1) {
                $id = $this->tambahProdi($value);
                $key = array_search($value, $validated['prodi']);
                unset($validated['prodi'][$key]);
                array_push($validated['prodi'], $id);
            }
        }
        if (is_numeric($validated['kategori']) != 1) {
            $validated['kategori'] = $this->tambahKategori($validated['kategori']);
        }
        try {
            $nomorMouFile = str_replace('/', '-', $validated['nomor_mou']);
            $fileMou->storeAs('public/file-mou', $nomorMouFile . "." . $fileMou->getClientOriginalExtension());
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            if (Auth::user()->role == "admin") {
                $validated['status'] = 1;
            }
            $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
            $permohonan = Kerjasama::create($validated);
            $permohonan->prodi()->attach($validated['prodi']);
            return redirect('/tambah-kerja-sama')->with('success', 'Berhasil Menambahkan Data Kerjasama');
        } catch (\Throwable $e) {
            return $e;
            // return redirect('/tambah-kerja-sama')->with('error', 'Gagal Menambahkan Data Kerjasama');
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
    public function show($id)
    {
        $kerjasama = Kerjasama::with(['prodi', 'kategori'])->findOrFail($id);
        $selectedProdi = [];
        foreach ($kerjasama->prodi as $key) {
            $selectedProdi[] = $key->id_prodi;
        }
        return  view('admin.kerjasama.editKerjasama', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'selectedProdi' =>  $selectedProdi
        ]);
    }
    public function update(UpdateKerjasamaRequest $request, $id)
    {
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        foreach ($validated['prodi'] as $value) {
            if (is_numeric($value) != 1) {
                $id = $this->tambahProdi($value);
                $key = array_search($value, $validated['prodi']);
                unset($validated['prodi'][$key]);
                array_push($validated['prodi'], $id);
            }
        }
        if (is_numeric($validated['kategori']) != 1) {
            $validated['kategori'] = $this->tambahKategori($validated['kategori']);
        }
        try {
            if (!empty($fileMou)) {
                $validated['nomor_mou_old'] = str_replace('/', '-', $validated['nomor_mou_old']);
                $nomorMouFile = str_replace('/', '-', $validated['nomor_mou']);
                if (Storage::exists('public/file-mou', $validated['nomor_mou_old'] . "." . $fileMou->getClientOriginalExtension())) {
                    Storage::delete('public/file-mou', $validated['nomor_mou_old'] . "." . $fileMou->getClientOriginalExtension());
                }
                $fileMou->storeAs('public/file-mou', $nomorMouFile . "." . $fileMou->getClientOriginalExtension());
                $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
            }
            if ($validated['nomor_mou_old'] != $validated['nomor_mou']) {
                $extension = explode('.', $validated['file_mou']);
                $nomorMouFile = str_replace('/', '-', $validated['nomor_mou']);
                Storage::rename('public/file-mou/' . $validated['file_mou'], 'public/file-mou/' . $nomorMouFile . '.' . $extension[1]);
                $validated['file_mou'] = $nomorMouFile . '.' . $extension[1];
            }
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            // if (Auth::user()->role == "admin") {
            //     $validated['status'] = "Diterima";
            // }
            // $permohonan = Kerjasama::($validated);
            $permohonan = Kerjasama::findOrFail($id);
            $permohonan->update($validated);
            // dd($permohonan->prodi()->sync($validated['prodi']));
            $permohonan->prodi()->sync($validated['prodi']);
            return redirect('/data-kerjasama')->with('success', 'Berhasil Mengubah Data Kerjasama');
        } catch (\Throwable $e) {
            return $e;
        }
    }
    public function destroy($id)
    {
        try {
            $kerjasama = Kerjasama::findOrFail($id);
            $kerjasama->delete();
            return redirect('/data-kerjasama')->with('success', 'Berhasil Menghapus Data Kerjasama');
        } catch (\Throwable $e) {
            // return $e;
            return redirect('/data-kerjasama')->with('error', 'Gagal Menghapus Data Kerjasama');
        }
    }
    public function detail($id)
    {
        $kerjasama = Kerjasama::with(['prodi', 'kategori'])->findOrFail($id);
        $selectedProdi = [];
        foreach ($kerjasama->prodi as $key) {
            $selectedProdi[] = $key->id_prodi;
        }
        return  view('admin.kerjasama.detailKerjasama', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'selectedProdi' =>  $selectedProdi
        ]);
    }
}
