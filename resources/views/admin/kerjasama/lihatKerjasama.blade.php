@extends('admin.layouts.app')
@push('css')
    <style>
        .tio-button {
            border: none !important;
            background: none !important;
            color: #004878;
            cursor: pointer;
        }

        .action {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Lihat Data Kerjasama</h4>
                        </div>
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="form mb-3" method="get" action="{{ route('cari-kerjasama') }}">
                                <div class="row">
                                    <div class="col-3 ">
                                        <label>Cari Data </label>

                                        <input type="text" name="cari" class="form-control" id="search"
                                            placeholder="Masukkan Nomor Mou / Nama Instansi">

                                    </div>
                                    <div class="col-3 ">
                                        <label>Filter Data </label>
                                        <select name="expired" class="form-control" id="">
                                            <option value="all" selected>--- Semua ---</option>
                                            <option value="akan_berakhir"
                                                {{ request('expired') == 'akan_berakhir' ? 'selected' : '' }}>Akan Berakhir
                                            </option>
                                            <option value="berakhir"
                                                {{ request('expired') == 'berakhir' ? 'selected' : '' }}>Telah Berakhir
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-3 ">
                                        <label>Urutkan Data </label>
                                        <select name="sort" class="form-control" id="">
                                            <option value="default" selected>--- Default ---</option>
                                            <option value="nama">Nama </option>
                                            <option value="tanggal_mulai">Tanggal Mulai</option>
                                            <option value="tanggal_berakhir">Tanggal Berakhir</option>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <label></label>
                                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
                                    </div>
                                </div>
                            </form>

                            {{-- <form action="" class="">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col">
                                        <form class="form" method="get" action="{{ route('cari-kerjasama') }}">
                                            <div class="form-group w-100 mb-3">
                                                <input type="text" name="cari" class="form-control w-75 d-inline"
                                                    id="search" placeholder="Masukkan Nomor Mou / Nama Instansi">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>
                                        </form>
                                        //
                                        <div class="form-group">
                                            <input type="text" name="cari"
                                                class="form-control @error('cari') is-invalid @enderror"placeholder="Masukkan Nomor Mou / Nama Instansi">
                                            @error('cari')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        //
                                    </div>
                                    ///
                                    <div class="col">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                    //
                                </div>
                            </form> --}}
                            <div class="table-responsive">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor Mou</th>
                                            <th scope="col">Nama Instansi</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal Mulai</th>
                                            <th scope="col">Tanggal Berakhir</th>
                                            <th scope="col">Hard File</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Soft File</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kerjasama as $item)
                                            <tr>
                                                <th scope="row">{{ $kerjasama->firstItem() + $loop->index }}</th>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td><a href="/download/{{ $item->nomor_mou }}">{{ $item->nomor_mou }}</a>
                                                </td>
                                                <td>{{ $item->nama_instansi }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>{{ $item->tgl_mulai }}</td>
                                                <td>{{ $item->tgl_berakhir }}</td>

                                                <td>
                                                    {{ $item->hard_file == 0 ? 'Tidak Tersedia' : 'Tersedia' }}
                                                </td>
                                                <td>{{ $item->status == 0 ? 'Belum Disetujui' : 'Disetujui' }}</td>
                                                <td class=""><a
                                                        href="/download/{{ str_replace('/', '-', $item->nomor_mou) }}"><i
                                                            class="icon-ganteng fa-solid fa-file-arrow-down"></i>
                                                <td class=" ">
                                                    <div class="action">
                                                        <a href="{{ route('edit-kerjasama', $item->id_kerjasama) }}"><i
                                                                class="icon-ganteng fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('detail-kerjasama', $item->id_kerjasama) }}"><i
                                                                class=" ml-1 icon-ganteng fa-solid fa-eye"></i></a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pl-2 ml-4">
                                    {{ $kerjasama->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    @push('js')
        {{-- <script>
            $('.tio-button').on("click", function(e) {
                e.preventDefault();
                // var form = $(this).parents('form');
                var form = $(this).closest("form");
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda Yakin ?',
                    showDenyButton: true,
                    confirmButtonText: 'Yakin',
                    denyButtonText: `Tidak`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.isDenied) {
                        Swal.fire('Data Tidak Ditambahkan', '', 'success')
                    }
                })
            })
        </script> --}}
    @endpush
@endsection
