$(document).ready(function () {
    const ctx = document.getElementById("chart-utama");
    let mychart;
    getDataAwal();

    function getData(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                console.log(data);
                mychart.data.labels = data.label;
                mychart.data.datasets.forEach((dataset) => {
                    dataset.data = data.data;
                });
                mychart.update();
            }
        );
    }

    function getDataAwal(tahunDari = "all", tahunKe = "all") {
        $.get(
            `/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
            function (data, status) {
                tampilData(data);
            }
        );
    }

    function tampilData(data) {
        mychart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: data.label,
                datasets: [
                    {
                        label: "Total Kerjasama Per Tahun",
                        data: data.data,
                        borderWidth: 1,
                        backgroundColor: "#004878",
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }
    $(".select-tahun").change(function () {
        let tahunDari = $("#tahunDari option:selected").val();
        let tahunKe = $("#tahunKe option:selected").val();
        console.log([tahunDari, tahunKe]);
        getData(tahunDari, tahunKe);
    });
});
