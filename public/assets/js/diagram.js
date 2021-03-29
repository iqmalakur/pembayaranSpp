let pembayaranChart = document.getElementById("lineChart").getContext("2d");
let data = JSON.parse(document.querySelector("textarea#pembayaran").value);
let tahun = [];
let jumlah = [];

// Memisahkan tahun dan jumlah pembayaran dari variabel data
data.forEach((item) => {
    tahun.push(item.tahun);
    jumlah.push(item.jumlah);
});

// Membuat diagram
let lineChart = new Chart(pembayaranChart, {
    type: "line",
    data: {
        labels: tahun,
        datasets: [
            {
                label: "Jumlah Pembayaran Spp",
                backgroundColor: "rgb(255, 99, 132)",
                borderColor: "rgb(255, 99, 132)",
                data: jumlah,
                fill: false,
            },
        ],
    },
    options: {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1500000,
                        callback: function (value, index, values) {
                            return convertToRupiah(value);
                        },
                    },
                },
            ],
        },
    },
});

let jurusanChart = document.getElementById("doughnutChart").getContext("2d");
let dataJurusan = JSON.parse(document.querySelector("textarea#jurusan").value);
let jurusanLabel = [];
let jurusanData = [];
let jurusanColor = ["rgb(26, 188, 156)", "rgb(52, 152, 219)", "rgb(155, 89, 182)", "rgb(241, 196, 15)", "rgb(231, 76, 60)", "rgb(149, 165, 166)", "rgb(46, 204, 113)", "rgb(52, 73, 94)", "rgb(230, 126, 34)", "rgb(189, 195, 199)"];

dataJurusan.forEach((item) => {
    jurusanLabel.push(item.nama);
    jurusanData.push(item.jumlah);
});

var doughnutChart = new Chart(jurusanChart, {
    type: "doughnut",
    data: {
        labels: jurusanLabel,
        datasets: [
            {
                backgroundColor: jurusanColor,
                borderColor: jurusanColor,
                data: jurusanData,
            },
        ],
    },
    // options: options,
});

function convertToRupiah(angka) {
    let rupiah = "";
    let angkarev = angka.toString().split("").reverse().join("");
    for (let i = 0; i < angkarev.length; i++) if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
    rupiah = rupiah
        .split("", rupiah.length - 1)
        .reverse()
        .join("");
    return "Rp. " + (rupiah.length < 1 ? "0" : rupiah) + ",00";
}
