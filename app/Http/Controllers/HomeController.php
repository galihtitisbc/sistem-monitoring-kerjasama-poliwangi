<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Prodi;
use App\Models\Kategori;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user   = auth()->user();
        // $last_login = Carbon::now()->diffInSeconds(Carbon::parse($user->last_login));
        $total_luar_negeri = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'luar negeri');
        })->count();
        $total_instansi_pemerintah = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'instansi pemerintah');
        })->count();
        $total_bumn = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'bumn');
        })->count();
        $total_pt = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'perguruan tinggi');
        })->count();
        $total_industri = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'Industri, Masyarakat dan PKL');
        })->count();
        $total_all = Kerjasama::count();
        // dd($total_luar_negeri . $total_instansi_pemerintah . $total_bumn . $total_pt . $total_industri);

        return view('admin.home', [
            'title'     =>  'Dashboard',
            'total_luar_negeri' => $total_luar_negeri,
            'total_instansi_pemerintah' => $total_instansi_pemerintah,
            'total_bumn' => $total_bumn,
            'total_pt' => $total_pt,
            'total_industri' => $total_industri,
            'total_all' => $total_all,
            // 'last_login' => $last_login
        ]);
    }
    public function dataChart(Request $request)
    {
        $kerjasama = Kerjasama::selectRaw('COUNT(id_kerjasama) as total,YEAR(created_at) as tahun');
        $kerjasama->when($request->query('tahunDari') != "all", function ($q) use ($request) {
            $q->whereYear('created_at', '>=', trim($request->query('tahunDari')));
        });
        $kerjasama->when($request->query('tahunKe') != "all", function ($q) use ($request) {
            $q->whereYear('created_at', '<=', trim($request->query('tahunKe')));
        });
        $kerjasama->groupBy('tahun')->orderBy('created_at', 'ASC');
        $data = [];
        foreach ($kerjasama->get() as $key => $value) {
            $data['data'][] = $value->total;
            $data['label'][] = $value->tahun;
        }
        return response()->json($data, 200);
    }
    public function dataChartProdi(Request $request)
    {
        $prodi = Prodi::withCount(['kerjasama' => function ($query) use ($request) {
            $query->when($request->query('tahunDari') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '>=', trim($request->query('tahunDari')));
            });
            $query->when($request->query('tahunKe') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '<=', trim($request->query('tahunKe')));
            });
        }])->get();
        $data = [];
        foreach ($prodi as $key) {
            $data['nama_prodi'][] = $key->nama_prodi;
            $data['total'][] = $key->kerjasama_count;
        }
        return response()->json($data, 200);
    }
    public function dataChartKategori(Request $request)
    {
        $prodi = Kategori::withCount(['kerjasama' => function ($query) use ($request) {
            $query->when($request->query('tahunDari') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '>=', trim($request->query('tahunDari')));
            });
            $query->when($request->query('tahunKe') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '<=', trim($request->query('tahunKe')));
            });
        }])->get();
        $data = [];
        foreach ($prodi as $key) {
            $data['nama_kategori'][] = $key->nama_kategori;
            $data['total'][] = $key->kerjasama_count;
        }
        return response()->json($data, 200);
    }
}
