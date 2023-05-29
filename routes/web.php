<?php

use App\Models\Kerjasama;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KerjasamaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});
// Route::get('/test', function () {
//     return
//         Kerjasama::selectRaw('COUNT(id_kerjasama) as total,YEAR(created_at) as tahun')->groupBy(DB::raw('YEAR(created_at)'))->get();
// });
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/tambah-kerja-sama', [KerjasamaController::class, 'tambahDataKerjasama']);
    Route::post('/tambah-kerjasama', [KerjasamaController::class, 'store']);
    Route::get('/data-kerjasama', [KerjasamaController::class, 'index']);
    Route::get('/download/{mou}', [KerjasamaController::class, 'download']);
    Route::get('/tampildatachart', [HomeController::class, 'dataChart']);
    Route::get('/data-chart-prodi', [HomeController::class, 'dataChartProdi']);
    Route::get('/data-chart-kategori', [HomeController::class, 'dataChartKategori']);
    Route::get('/edit-kerjasama/{id}', [KerjasamaController::class, 'show'])->name('edit-kerjasama');
    Route::put('/edit-kerjasama/{id}', [KerjasamaController::class, 'update'])->name('update-kerjasama');
    Route::delete('/hapus-kerjasama/{id}', [KerjasamaController::class, 'destroy'])->name('hapus-kerjasama');
    Route::get('/detail-kerjasama/{id}', [KerjasamaController::class, 'detail'])->name('detail-kerjasama');
    Route::get('/data-kerjasama', [KerjasamaController::class, 'cari'])->name('cari-kerjasama');
});
Route::get('/test', [HomeController::class, 'dataChartProdi']);
