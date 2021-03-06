// Konfirmasi Hapus Data
$("span.delete").click(function () {
    Swal.fire({
        title: "Anda yakin akan Menghapus?",
        text: this.dataset.item + " akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0d6efd",
        cancelButtonColor: "#dc3545",
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
    const Toast = Swal.mixin({
        toast: true,
        position: "top-right",
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "X",
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
        position: "top-right",
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "X",
        timer: 5000,
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
