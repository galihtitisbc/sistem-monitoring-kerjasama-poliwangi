$(document).ready(function () {
    const chartProdi = document.getElementById("chart-prodi");
    let dataChart;

    getDataAwalProdi();

    function getDataProdi(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/data-chart-prodi?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                dataChart.data.datasets[0].data = data.total;
                dataChart.update();
            }
        );
    }

    function getDataAwalProdi(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/data-chart-prodi?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                tampilDataProdi(data);
            }
        );
    }

    function tampilDataProdi(data) {
        dataChart = new Chart(chartProdi, {
            type: "doughnut",
            data: {
                labels: data.nama_prodi,
                datasets: [
                    {
                        label: "Total",
                        data: data.total,
                        backgroundColor: [
                            "rgb(255, 99, 132)",
                            "rgb(54, 162, 235)",
                            "rgb(200, 205, 86)",
                            "rgb(225, 205, 82)",
                            "rgb(235, 201, 87)",
                        ],
                        // hoverOffset: 4,
                    },
                ],
            },
            options: {
                plugins: {
                    datalabels: {
                        color: "#000", // Label text color
                        font: {
                            weight: "bold",
                        },
                        display: true, // Show labels by default
                    },
                },
            },
        });
    }

    $(".select-tahun-prodi").change(function () {
        let tahunDari = $("#tahunDariProdi option:selected").val();
        let tahunKe = $("#tahunKeProdi option:selected").val();
        console.log([tahunDari, tahunKe]);
        getDataProdi(tahunDari, tahunKe);
    });
});
