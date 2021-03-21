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
        dataType: "json",
        success: function (siswa) {
            $("#pembayaran-siswa").val(siswa.nisn);
            $("#pembayaran-siswa-info").val(siswa.nama + " - " + siswa.nama_kelas);
            $("#pembayaran-spp").val(siswa.id_spp);
            $("#pembayaran-spp-info").val(siswa.tahun);
            $("#pembayaran-tahun").val(siswa.tahun);
            $("#pembayaran-jumlah").val(siswa.nominal);

            let nisn = siswa.nisn;

            $.ajax({
                url: "/ajaxSiswa/",
                type: "POST",
                data: { nisn },
                success: function (result) {
                    $("tbody#data-pembayaran").html(result);
                },
            });

            let modal = bootstrap.Modal.getInstance(document.getElementById("siswaModal"));
            modal.hide();
        },
    });
}
