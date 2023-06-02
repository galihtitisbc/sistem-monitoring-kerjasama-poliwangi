@php
    $dataKerjasama = App\Models\Kerjasama::all();
    $dataKerjasamaArray = [];
    foreach ($dataKerjasama as $key => $value) {
        $tglSekarang = Carbon\Carbon::now();
        $tglBerakhir = Carbon\Carbon::parse($value->tgl_berakhir);
        if ($tglBerakhir->gte($tglSekarang)) {
            if ($tglSekarang->diffInMonths($tglBerakhir) <= 3) {
                $dataKerjasamaArray[] = [
                    'tgl_berakhir' => $value->tgl_berakhir,
                    'nomor_mou' => $value->nomor_mou,
                    'status' => 'Akan Berakhir',
                ];
            }
        } else {
            $dataKerjasamaArray[] = [
                'tgl_berakhir' => $value->tgl_berakhir,
                'nomor_mou' => $value->nomor_mou,
                'status' => 'Berakhir',
            ];
        }
    }
@endphp
<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
            {{-- <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div> --}}
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
            @foreach ($dataKerjasamaArray as $item)
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        @if ($item['status'] == 'Berakhir')
                            <i class="fa-solid fa-stopwatch"></i>
                        @else
                            <i class="fas fa-bell"></i>
                        @endif
                    </div>
                    <div class="dropdown-item-desc">
                        Kerjasama Dengan Nomor MOU {{ $item['nomor_mou'] }}
                        @if ($item['status'] == 'Berakhir')
                            <div class="time text-primary">Telah Berakhir Pada {{ $item['tgl_berakhir'] }}</div>
                        @else
                            <div class="time text-primary">Akan Berakhir Pada {{ $item['tgl_berakhir'] }}</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
        <div class="dropdown-footer text-center">
            {{-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> --}}
        </div>
    </div>
</li>
