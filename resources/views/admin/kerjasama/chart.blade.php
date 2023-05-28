    <div class="card">
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-4">
                        <label for="tahunDari">Dari Tahun : </label>
                        <select name="tahunDari" class="form-control select-tahun" id="tahunDari">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="tahunKe">Ke Tahun : </label>
                        <select name="tahunKe" class="form-control select-tahun" id="tahunKe">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <canvas id="chart-utama"></canvas>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/chart-utama.js') }}"></script>
    @endpush
