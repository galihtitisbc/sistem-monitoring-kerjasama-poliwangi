<div>
    <div class="card">
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-4">
                        <select name="tahunDari" class="form-control select-tahun" id="tahunDari">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
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
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            const ctx = document.getElementById('chart-utama');
            let mychart;
            getDataAwal()

            function getData(tahunDari = "all", tahunKe = "all") {
                $.get(`/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`, function(data, status) {
                    console.log(data);
                    mychart.data.labels = data.label;
                    mychart.data.datasets.forEach((dataset) => {
                        dataset.data = data.data;
                    });
                    mychart.update()
                });
            }

            function getDataAwal(tahunDari = "all", tahunKe = "all") {
                $.get(`/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`, function(data, status) {
                    tampilData(data);
                });
            }

            function tampilData(data) {
                mychart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.label,
                        datasets: [{
                            label: 'Total Kerjasama Per Tahun',
                            data: data.data,
                            borderWidth: 1,
                            backgroundColor: "blue"
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
            $(".select-tahun").change(function() {
                let tahunDari = $('#tahunDari option:selected').val();
                let tahunKe = $('#tahunKe option:selected').val();
                getData(tahunDari, tahunKe)
            });

        });
    </script>
@endpush
