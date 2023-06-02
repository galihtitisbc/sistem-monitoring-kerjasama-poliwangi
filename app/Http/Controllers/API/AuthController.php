<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);
        $data = $validate->validated();
        if (!Auth::attempt($data)) {
            return response()->json([
                'status'   =>  'Gagal',
                'message'   =>  'user tidak ditemukan',
            ]);
        }
        $user = User::where('email', Auth::user()->email)->first();
        $token = $user->createToken('token-auth')->plainTextToken;
        $respon = [
            'status' => 'success',
            'msg' => 'Login successfully',
            'errors' => null,
            'content' => [
                'status_code' => 200,
                'access_token' => $token,
                'role'  => $user->role,
                'token_type' => 'Bearer',
            ]
        ];
        return response()->json($respon, 200);
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $expired = $request->expired;
        $kerjasama = Kerjasama::query();
        $kerjasama->when($cari != null, function ($q) use ($cari) {
            return $q->where('nomor_mou', 'like', "%" . $cari . "%")
                ->orWhere('nama_instansi', 'like', "%" . $cari . "%");
        });
        $kerjasama->when($expired == 'berakhir', function ($q) use ($expired) {
            return $q->where('tgl_berakhir', '<=', Carbon::now());
        });
        $kerjasama->when($expired == 'akan_berakhir', function ($q) use ($expired) {
            return $q->whereBetween('tgl_berakhir', [Carbon::now(), Carbon::now()->addMonth(3)]);
        });
        return response()->json([
            'data'  =>  $kerjasama->orderBy('id_kerjasama', 'DESC')->get()
        ], 200);
    }
}
