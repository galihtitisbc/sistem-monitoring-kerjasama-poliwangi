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
                <canvas id="myChart23"></canvas>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $('.select-tahun').on('change', function() {
            // Livewire.emit('$refresh')
        });
        let dataKerjasama = <?php echo json_encode($kerjasama); ?>;
        console.log(dataKerjasama);
        const ctx = document.getElementById('myChart23');
        const ctx2 = document.getElementById('myChart44');

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
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
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
    </script>
@endpush
