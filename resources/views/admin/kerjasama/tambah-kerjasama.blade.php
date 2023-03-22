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
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputinstansi1">Nama Instansi</label>
                                            <input type="text" class="form-control col" id="exampleInputinstansi1"
                                                aria-describedby="instansiHelp" placeholder="Masukkan Nama Instansi">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputkegiatan1">Jenis Kegiatan</label>
                                            <input type="text" class="form-control col" id="exampleInputkegiatan1"
                                                aria-describedby="kegiatanHelp" placeholder="Jenis Kegiatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Manfaat Kerjasama</label>
                                            <textarea class="form-control" name="manfaat" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="exampleFormControldate1">Tanggal Mulai</label>
                                                    <input type="date" class="form-control" id="exampleFormControldate1">
                                                </div>
                                                <div class="col">
                                                    <label for="exampleFormControldate2">Tanggal Berakhir</label>
                                                    <input type="date" class="form-control" id="exampleFormControldate2">
                                                </div>
                                                <div class="col">
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="prodi">Masukkan Prodi</label>
                                            <select class="form-control prodi" id="prodi" name="prodi[]"
                                                multiple="multiple">
                                                @foreach ($prodi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="prodi">Masukkan Kategori</label>
                                            <select class="form-control kategori" id="kategori" name="kategori">
                                                <option value=""></option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputmou1">File Mou</label>
                                            <input type="file" class="form-control" name="mou" id="">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                $('.prodi').select2();
            });
        </script>
    @endpush
@endsection
