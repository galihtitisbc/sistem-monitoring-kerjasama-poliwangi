@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Data Kerjasama</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ url('tambah-kerjasama') }}" method="POST" enctype="multipart/form-data"
                                id="form-tambah">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Nama Instansi</label>
                                            <input type="text" name="nama_instansi"
                                                class="form-control  @error('nama_instansi')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputinstansi1" aria-describedby="instansiHelp"
                                                placeholder="Masukkan Nama Instansi" value="{{ old('nama_instansi') }}">
                                            @error('nama_instansi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputkegiatan1">Jenis Kegiatan</label>
                                            <input type="text" name="jenis_kegiatan"
                                                class="form-control @error('jenis_kegiatan')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputkegiatan1" aria-describedby="kegiatanHelp"
                                                placeholder="Jenis Kegiatan" value="{{ old('jenis_kegiatan') }}">
                                            @error('jenis_kegiatan')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Manfaat Kerjasama</label>
                                            <textarea placeholder="Masukkan Manfaat Kerjasama"
                                                class="form-control @error('manfaat')
                                                is-invalid
                                            @enderror"
                                                name="manfaat" id="exampleFormControlTextarea1" rows="3" cols="5">{{ old('manfaat') }}</textarea>
                                            @error('manfaat')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea2">Implmentasi Kerjasama</label>
                                            <textarea placeholder="Masukkan Implementasi Kerjasama"
                                                class="form-control @error('implementasi')
                                                is-invalid
                                            @enderror"
                                                name="implementasi" id="exampleFormControlTextarea2" cols="5" rows="3">{{ old('implementasi') }}</textarea>
                                            @error('implementasi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleFormControldate1">Tanggal Mulai</label>
                                                    <input type="date" name="tgl_mulai"
                                                        class="form-control @error('tgl_mulai')
                                                is-invalid
                                            @enderror"
                                                        id="exampleFormControldate1" value="{{ old('tgl_mulai') }}">
                                                    @error('tgl_mulai')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControldate2">Tanggal Berakhir</label>
                                                    <input type="date" name="tgl_berakhir"
                                                        class="form-control @error('tgl_berakhir')
                                                is-invalid
                                            @enderror"
                                                        id="exampleFormControldate2" value="{{ old('tgl_berakhir') }}">
                                                    @error('tgl_berakhir')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                                {{-- <div class="col">
                                                </div>
                                                <div class="col">
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="prodi">Masukkan Prodi</label>
                                            <select
                                                class="form-control @error('prodi')
                                                is-invalid
                                            @enderror prodi"
                                                id="prodi" name="prodi[]" multiple="multiple">
                                                @foreach ($prodi as $item)
                                                    <option value="{{ $item->id_prodi }}">
                                                        {{ $item->nama_prodi }}</option>
                                                @endforeach
                                            </select>
                                            @error('prodi')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="prodi">Masukkan Kategori</label>
                                            <select
                                                class="form-control @error('kategori')
                                                is-invalid
                                            @enderror kategori"
                                                id="kategori" name="kategori">
                                                <option value=""></option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id_kategori }}"
                                                        {{ old('kategori') == $item->id_kategori ? 'selected' : '' }}>
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputmou1">File Mou</label>
                                            <input type="file"
                                                class="form-control @error('mou')
                                                is-invalid
                                            @enderror"
                                                name="mou" id="" value="{{ old('mou') }}">
                                            @error('mou')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputmou1">Nomor Mou</label>
                                            <input type="text"
                                                class="form-control @error('nomor_mou')
                                                is-invalid
                                            @enderror"
                                                id="exampleInputmou1" name="nomor_mou" aria-describedby="mouHelp"
                                                placeholder="Nomor Mou" value="{{ old('nomor_mou') }}">
                                            @error('nomor_mou')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="hard_file">Hard File</label>
                                            <select
                                                class="form-control @error('hard_file')
                                                is-invalid
                                            @enderror hard_file"
                                                id="hard_file" name="hard_file">
                                                <option value=""></option>

                                                <option value="0" selected>
                                                    Tidak Ada
                                                </option>
                                                <option value="1">
                                                    Ada
                                                </option>
                                            </select>
                                            @error('hard_file')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="button-tambah" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#prodi').select2({
                    tags: true,
                    placeholder: "Pilih Prodi",
                    // selectionCssClass: "form-control"

                });
                $('#kategori').select2({
                    tags: true,
                    placeholder: "Pilih Kategori"
                });
                $('#button-tambah').on("click", function(e) {
                    e.preventDefault();
                    var form = $(this).parents('form');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Apakah Anda Yakin ?',
                        showDenyButton: true,
                        confirmButtonText: 'Yakin',
                        denyButtonText: `Tidak`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#form-tambah").submit();
                        } else if (result.isDenied) {
                            Swal.fire('Data Tidak Ditambahkan', '', 'success')
                        }
                    })
                })
            });
        </script>
    @endpush
@endsection
