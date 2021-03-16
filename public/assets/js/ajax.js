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

$("#cari-siswa").on("keyup", function () {
    $.ajax({
        url: "/ajaxPembayaran/",
        type: "POST",
        data: { keyword: this.value },
        success: function (result) {
            $("#container-cari").html(result);
            $(".data-siswa").click(cariSiswa);
        },
    });
});

$(".data-siswa").click(cariSiswa);

function cariSiswa() {
    $.ajax({
        url: "/getSiswa/",
        type: "POST",
        data: { nisn: $(this).children()[1].innerHTML },
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
