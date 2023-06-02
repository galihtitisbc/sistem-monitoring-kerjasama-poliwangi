@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Luar Negeri</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_luar_negeri }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Instansi Pemerintah</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_instansi_pemerintah }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-business-time"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>BUMN</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_bumn }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-school	"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Perguruan Tinggi</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_pt }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-people-arrows"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Industri, UMKM, Masyarakat</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_industri }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_all }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    @include('admin.kerjasama.chart')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    @include('admin.kerjasama.chart-prodi')
                </div>
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    @include('admin.kerjasama.chart-kategori')
                </div>
            </div>
        </section>
    </div>
@endsection
