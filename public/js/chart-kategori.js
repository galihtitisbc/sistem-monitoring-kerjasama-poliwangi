$(document).ready(function () {
    const chartKategori = document.getElementById("chart-kategori");
    let dataChart;

    getDataAwalKategori();

    function getDataKategori(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/data-chart-kategori?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                console.log(data);
                dataChart.data.datasets[0].data = data.total;
                dataChart.update();
            }
        );
    }

    function getDataAwalKategori(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/data-chart-kategori?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                tampilDataKategori(data);
            }
        );
    }

    function tampilDataKategori(data) {
        console.log(data);
        dataChart = new Chart(chartKategori, {
            type: "doughnut",
            data: {
                labels: data.nama_kategori,
                datasets: [
                    {
                        label: "Total : ",
                        data: data.total,
                        backgroundColor: [
                            "rgb(255, 99, 132)",
                            "rgb(54, 162, 235)",
                            "rgb(255, 205, 86)",
                        ],
                        hoverOffset: 4,
                    },
                ],
            },
        });
    }

    $(".select-tahun-kategori").change(function () {
        let tahunDari = $("#tahunDariKategori option:selected").val();
        let tahunKe = $("#tahunKeKategori option:selected").val();
        console.log([tahunDari, tahunKe]);
        getDataKategori(tahunDari, tahunKe);
    });
});
