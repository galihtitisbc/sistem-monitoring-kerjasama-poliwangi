<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kerjasama;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartUtama extends Component
{
    public $dataKerjasama;
    public $tahunDari = "all";
    public $tahunKe = "all";
    protected $queryString = ['tahunDari', 'tahunKe'];
    protected $listeners = ['ubahData' => 'updateData'];
    public function render()
    {
        $kerjasama = Kerjasama::selectRaw('COUNT(id_kerjasama) as total,YEAR(created_at) as tahun');
        $kerjasama->when($this->tahunDari != "all", function ($q) {
            $q->whereYear('created_at', '>=', trim($this->tahunDari));
        });
        $kerjasama->when($this->tahunKe != "all", function ($q) {
            $q->whereYear('created_at', '>=', trim($this->tahunKe));
        });
        $kerjasama->groupBy(DB::raw('YEAR(created_at)'))->orderBy('created_at', 'ASC');
        $data = [];
        foreach ($kerjasama->get() as $key => $value) {
            $data['data'][] = $value->total;
            $data['label'][] = $value->tahun;
        }
        $this->dataKerjasama = $data;
        return view('livewire.chart-utama');
    }
    public function updateData()
    {
        $this->emit('berhasilUpdate', ['data' => $this->dataKerjasama]);
    }
}
