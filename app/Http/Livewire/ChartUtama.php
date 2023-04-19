<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kerjasama;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartUtama extends Component
{
    public $tahunDari = "all";
    public $tahunKe = "all";
    protected $queryString = ['tahunDari', 'tahunKe'];
    public function render()
    {
        $kerjasama = Kerjasama::selectRaw('COUNT(id_kerjasama) as total,YEAR(created_at) as tahun');
        if ($this->tahunDari != "all") {
            $kerjasama->whereYear('created_at', '>=', trim($this->tahunDari));
        }
        if ($this->tahunKe != "all") {
            $kerjasama->whereYear('created_at', '<=', trim($this->tahunKe));
        }
        $kerjasama->groupBy(DB::raw('YEAR(created_at)'))->orderBy('created_at', 'ASC');
        $data = [];
        foreach ($kerjasama->get() as $key => $value) {
            $data['data'][] = $value->total;
            $data['label'][] = $value->tahun;
        }
        return view('livewire.chart-utama', [
            'kerjasama' =>  $data
        ]);
    }
}
