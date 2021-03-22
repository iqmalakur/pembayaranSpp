let ctx = document.getElementById("pembayaranChart").getContext("2d");
let pembayaran = JSON.parse(document.querySelector("textarea").value);
let data = [];
let diagram = [];

pembayaran.forEach((item) => {
    data.push({ tahun: item.tahun_dibayar, total: item.total, visible: true });
    diagram.push(item.tahun_dibayar);
});

chart();

$(".list-group-item input[type=checkbox]").change(function () {
    let tahun = $(this).val();

    if ($(this).is(":checked")) {
        diagram.push(tahun);
    } else {
        Array.prototype.remove = function () {
            var what,
                a = arguments,
                L = a.length,
                ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        diagram.remove(tahun);
    }

    data.forEach((item) => {
        if (diagram.indexOf(item.tahun) < 0) {
            item.visible = false;
        } else {
            item.visible = true;
        }
    });

    chart();
});

function chart() {
    let tahun = [];
    let count = [];

    data.forEach((item) => {
        if (item.visible) {
            tahun.push(item.tahun);
            count.push(item.total);
        }
    });

    let chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: tahun,
            datasets: [
                {
                    label: "Pembayaran Spp",
                    backgroundColor: "rgb(255, 99, 132)",
                    borderColor: "rgb(255, 99, 132)",
                    data: count,
                },
            ],
        },
    });
}
