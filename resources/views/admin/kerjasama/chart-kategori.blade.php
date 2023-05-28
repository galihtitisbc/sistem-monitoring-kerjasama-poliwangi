    <div class="card">
        <div class="card-body">
            <div>
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <label for="tahunDariKategori">Dari Tahun : </label>
                        <select name="tahunDariKategori" class="form-control select-tahun-kategori" id="tahunDariKategori">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="tahunKeKategori">Ke Tahun : </label>
                        <select name="tahunKeKategori" class="form-control select-tahun-kategori" id="tahunKeKategori">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <canvas id="chart-kategori"></canvas>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/chart-kategori.js') }}"></script>
    @endpush
