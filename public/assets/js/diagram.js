let canvasPembayaran = document.getElementById("canvasPembayaran").getContext("2d");
let data = JSON.parse(document.querySelector("textarea#pembayaran").value);
let tahun = [];
let jumlah = [];

// Memisahkan tahun dan jumlah pembayaran dari variabel data
data.forEach((item) => {
    tahun.push(item.tahun);
    jumlah.push(item.jumlah);
});

// Membuat diagram
let diagramPembayaran = new Chart(canvasPembayaran, {
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
                        callback: function (value, index, values) {
                            return convertToRupiah(value);
                        },
                    },
                },
            ],
        },
    },
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
