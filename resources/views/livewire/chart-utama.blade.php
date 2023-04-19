<div>
    <div class="card">
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="col-4">
                        {{ $tahunDari }}
                        <select wire:model="tahunDari" class="form-control select-tahun" id="">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        {{ $tahunKe }}
                        <select wire:model="tahunKe" class="form-control select-tahun" id="">
                            <option value="all">Semua Tahun</option>
                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                <option value=" {{ $year }}"> {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{ print_r($dataKerjasama) }}
                <canvas id="chart-utama"></canvas>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        setInterval(() => Livewire.emit('ubahData'), 3000);
        let dataKerjasama = {{ Illuminate\Support\Js::from($dataKerjasama) }}
        $('.select-tahun').on('change', function() {

        });
        console.log(dataKerjasama);
        const ctx = document.getElementById('chart-utama');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataKerjasama.label,
                datasets: [{
                    label: 'Total Kerjasama Per Tahun',
                    data: dataKerjasama.data,
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
        Livewire.on('updateData', event => {
            alert("dfg")
            console.log("df");
        })
    </script>
@endpush
