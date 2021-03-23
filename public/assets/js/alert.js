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

// Message
if ($("#message").length) {
    Swal.fire({
        icon: $("#message").data("icon"),
        title: $("#message").data("title"),
        text: $("#message").data("text"),
    });
}

// Alert Berhasil
if ($("#success-info").length) {
    // Swal.fire({
    //     icon: "success",
    //     title: "Berhasil " + $('#success-info').data('title') + " data",
    //     timer: 3000,
    //     timerProgressBar: true,
    // });

    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-right",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        title: "Berhasil " + $("#success-info").data("title") + " data",
    });
}

// Alert Berhasil Login
if ($("#login-success").length) {
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-right",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        title: "Login berhasil",
    });
}

$("#btn-cari-siswa").click(function () {
    setTimeout(() => {
        $("#cari-siswa").focus();
    }, 500);
});
