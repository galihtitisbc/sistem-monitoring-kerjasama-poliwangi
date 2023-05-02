$(document).ready(function () {
    const chartProdi = document.getElementById("chart-prodi");
    const data = {
        labels: ["Red", "Blue", "Yellow"],
        datasets: [
            {
                label: "My First Dataset",
                data: [300, 50, 100],
                backgroundColor: [
                    "rgb(255, 99, 132)",
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                ],
                hoverOffset: 4,
            },
        ],
    };
    new Chart(chartProdi, {
        type: "doughnut",
        data: data,
    });
    // getDataAwal();

    // function getData(tahunDari = "all", tahunKe = "all") {
    //     $.get(
    //         `/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
    //         function (data, status) {
    //             console.log(data);
    //             mychart.data.labels = data.label;
    //             mychart.data.datasets.forEach((dataset) => {
    //                 dataset.data = data.data;
    //             });
    //             mychart.update();
    //         }
    //     );
    // }

    // function getDataAwal(tahunDari = "all", tahunKe = "all") {
    //     $.get(
    //         `/tampildatachart?tahunDari=${tahunDari}&tahunKe=${tahunKe}`,
    //         function (data, status) {
    //             tampilData(data);
    //         }
    //     );
    // }

    // function tampilData(data) {
    // }

    // $(".select-tahun").change(function () {
    //     let tahunDari = $("#tahunDari option:selected").val();
    //     let tahunKe = $("#tahunKe option:selected").val();
    //     console.log([tahunDari, tahunKe]);
    //     getData(tahunDari, tahunKe);
    // });
});
