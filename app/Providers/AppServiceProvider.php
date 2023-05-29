<?php

namespace App\Providers;

use App\Models\Kerjasama;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $dataKerjasama = Kerjasama::all();
        $dataKerjasamaArray = [];
        foreach ($dataKerjasama as $key => $value) {
            $tglSekarang = Carbon::now();
            $tglBerakhir = Carbon::parse($value->tgl_berakhir);
            if ($tglBerakhir->gte($tglSekarang)) {
                if ($tglSekarang->diffInMonths($tglBerakhir) <= 3) {
                    $dataKerjasamaArray[] = [
                        'tgl_berakhir' => $value->tgl_berakhir,
                        'nomor_mou' => $value->nomor_mou,
                        'status'    => 'Akan Berakhir'
                    ];
                }
            } else {
                $dataKerjasamaArray[] = [
                    'tgl_berakhir' => $value->tgl_berakhir,
                    'nomor_mou' => $value->nomor_mou,
                    'status'    => 'Berakhir'
                ];
            }
        }
        view()->composer('*', function ($view) use ($dataKerjasamaArray) {
            $view->with('kerjasamaArray', $dataKerjasamaArray);
        });
    }
}
