// Menjalankan loader saat terjadi ajax
$(document).on({
    // Menghilangkan Loader
    ajaxStart: function () {
        $("#loader").removeClass("d-none");
        $("#container-cari").addClass("d-none");
    },

    // Memunculkan Loader
    ajaxStop: function () {
        $("#loader").addClass("d-none");
        $("#container-cari").removeClass("d-none");
    },
});

// Cari Siswa pada entri pembayaran
$("#cari-siswa").on("keyup", function (e) {
    // Cek apakah tombol enter ditekan
    if (e.keyCode === 13) {
        // Memilih Siswa yang berada pada urutan teratas
        if ($("#container-cari").children().length !== 0) {
            cariSiswa($("#container-cari").children()[0].children[1].innerHTML);
        }
    } else {
        // Mengambil data siswa
        $.ajax({
            url: "/ajaxPembayaran/",
            type: "POST",
            data: { keyword: this.value },
            success: function (result) {
                $("#container-cari").html(result);

                // Event jika data siswa pada modal entri pembayaran di-klik
                $(".data-siswa").click(function () {
                    cariSiswa($(this).children()[1].innerHTML);
                });
            },
        });
    }
});

// Event jika data siswa pada modal entri pembayaran di-klik
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
            // Mengisi form secara otomatis sesuai data siswa
            $("#pembayaran-siswa").val(siswa.nisn);
            $("#pembayaran-siswa-info").val(siswa.nama + " - " + siswa.nama_kelas);
            $("#pembayaran-spp").val(siswa.id_spp);
            $("#pembayaran-tahun").val(siswa.angkatan);
            $("#pembayaran-jumlah").val(siswa.nominal);

            // Mengisi data pembayaran siswa
            $.ajax({
                url: "/ajaxSiswa/",
                type: "POST",
                data: { nisn: siswa.nisn },
                success: function (result) {
                    $("tbody#data-pembayaran").html(result);
                },
            });

            // Menutup modal
            let modal = bootstrap.Modal.getInstance(document.getElementById("siswaModal"));
            modal.hide();
        },
    });
}

// Event saat tahun laporan diganti
$("#filter-laporan").change(function () {
    $.ajax({
        url: "/ajaxLaporan/",
        type: "POST",
        data: { tahun: $(this).val() },
        success: function (result) {
            $("tbody#container-cari").html(result);

            // Mengubah tujuan dari tombol print
            $("#print-laporan").attr("href", "/laporan/" + $("#filter-laporan").val());
        },
    });
});

// AJAX cari data
// ================================================
$("input#search-jurusan").on("keyup", function () {
    search("/cariJurusan/", $(this));
});

$("input#search-kelas").on("keyup", function () {
    search("/cariKelas/", $(this));
});

$("input#search-spp").on("keyup", function () {
    search("/cariSpp/", $(this));
});

$("input#search-petugas").on("keyup", function () {
    search("/cariPetugas/", $(this));
});

$("input#search-siswa").on("keyup", function () {
    search("/cariSiswa/", $(this));
});

function search(url, input) {
    $.ajax({
        url: url,
        type: "POST",
        data: { keyword: input.val() },
        success: function (result) {
            if (input.val() == "") {
                location.reload();
                $("#pagination").removeClass("d-none");
            } else {
                $("#pagination").addClass("d-none");
            }

            $("tbody#container-cari").html(result);

            // Konfirmasi Hapus Data
            $("span.delete").click(function () {
                Swal.fire({
                    title: "Anda yakin akan Menghapus?",
                    text: this.dataset.item + " akan dihapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus data ini!",
                    cancelButtonText: "Jangan hapus data!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                });
            });
        },
    });
}
// ================================================
