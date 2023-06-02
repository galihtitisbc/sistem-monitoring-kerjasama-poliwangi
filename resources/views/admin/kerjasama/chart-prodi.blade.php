    <div class="card">
        <div class="card-body">
            <div>
                <div class="row d-flex justify-content-center">
                    <div class="col-4 mr-4">
                        <label for="tahunDariProdi">Dari Tahun : </label>
                        <select name="tahunDariProdi" class="form-control select-tahun-prodi" id="tahunDariProdi">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="tahunKeProdi">Ke Tahun : </label>
                        <select name="tahunKeProdi" class="form-control select-tahun-prodi" id="tahunKeProdi">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <canvas id="chart-prodi"></canvas>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        <script src="{{ asset('js/chart-prodi.js') }}"></script>
    @endpush
