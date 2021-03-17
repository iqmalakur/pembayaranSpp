$(document).on({
    ajaxStart: function () {
        $("#loader").removeClass("d-none");
        $("#container-cari").addClass("d-none");
    },
    ajaxStop: function () {
        $("#loader").addClass("d-none");
        $("#container-cari").removeClass("d-none");
    },
});

$("#cari-siswa").on("keyup", function (e) {
    if (e.keyCode === 13) {
        if ($("#container-cari").children().length !== 0) {
            cariSiswa($("#container-cari").children()[0].children[1].innerHTML);
        }
    } else {
        $.ajax({
            url: "/ajaxPembayaran/",
            type: "POST",
            data: { keyword: this.value },
            success: function (result) {
                $("#container-cari").html(result);
                $(".data-siswa").click(function () {
                    cariSiswa($(this).children()[1].innerHTML);
                });
            },
        });
    }
});

$(".data-siswa").click(function () {
    cariSiswa($(this).children()[1].innerHTML);
});

function cariSiswa(siswa) {
    $.ajax({
        url: "/getSiswa/",
        type: "POST",
        data: { nisn: siswa },
        success: function (result) {
            let siswa = result.split(",");

            $("#pembayaran-siswa").val(siswa[0]);
            $("#pembayaran-siswa-info").val(siswa[1]);
            $("#pembayaran-spp").val(siswa[2]);
            $("#pembayaran-spp-info").val(siswa[3]);
            $("#pembayaran-tahun").val(siswa[3]);
            $("#pembayaran-jumlah").val(siswa[4]);

            let modal = bootstrap.Modal.getInstance(document.getElementById("siswaModal"));
            modal.hide();
        },
    });
}
