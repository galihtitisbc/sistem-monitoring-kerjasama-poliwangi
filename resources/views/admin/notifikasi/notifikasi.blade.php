<li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
        class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
            {{-- <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div> --}}
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
            @foreach ($kerjasama as $item)
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dropdown-item-desc">
                        Kerjasama Dengan Nomor MOU {{ $item['nomor_mou'] }}
                        <div class="time text-primary">{{ $item['tgl_berakhir'] }}</div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="dropdown-footer text-center">
            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>
