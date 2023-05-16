@extends('admin.layouts.app')
@push('css')
    <style>
        .tio-button {
            border: none !important;
            background: none !important;
            color: #780000;
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
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" name="cari"
                                                class="form-control @error('cari') is-invalid @enderror"placeholder="Masukkan Nomor Mou / Nama Instansi">
                                            @error('cari')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                                            class="icon-ganteng fa-solid fa-folder-arrow-down"></i></a></td>
                                                <td class=" ">
                                                    <div class="action">
                                                        <a href="{{ route('edit-kerjasama', $item->id_kerjasama) }}"><i
                                                                class="icon-ganteng fa-solid fa-pen-to-square"></i></a>
                                                        <form method="POST" class="submitdelete"
                                                            action="{{ route('hapus-kerjasama', $item->id_kerjasama) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="tio-button" type="submit" href=""><i
                                                                    class="icon-ganteng fa-solid fa-trash-can"></i></button>

                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pagination pl-2 ml-4">
                            {{ $kerjasama->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    @push('js')
        <script>
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
        </script>
    @endpush
@endsection
