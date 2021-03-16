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

// Field Username
$("input[name=username]").on("input", function () {
    this.value = this.value.toLowerCase();
});

// Controller Jurusan
$("input[name=alias]").on("input", function () {
    this.value = this.value.toUpperCase();
});

// Controller Kelas
$("#nama-kelas").on("input", function () {
    this.value = this.value.toUpperCase();
});

// Controller Siswa
$("input[name=nisn]").on("input", function () {
    if (this.value.length < 10 || this.value.length > 10 || this.value == "") {
        $(this).addClass("is-invalid");
        $("#nisnFeedback").html("NISN harus terdiri dari 10 karakter!");
    } else {
        $(this).removeClass("is-invalid");
        $("#nisnFeedback").html("");
    }
});

$("input[name=nis]").on("input", function () {
    if (this.value.length < 8 || this.value.length > 8 || this.value == "") {
        $(this).addClass("is-invalid");
        $("#nisFeedback").html("NIS harus terdiri dari 8 karakter!");
    } else {
        $(this).removeClass("is-invalid");
        $("#nisFeedback").html("");
    }
});

// Controller Spp
$("input[name=tahun]").on("input", function () {
    if (parseInt(this.value) < 1000 || parseInt(this.value) > 9999 || this.value == "") {
        $(this).addClass("is-invalid");
        $("#tahunFeedback").html("Tahun harus terdiri dari 4 digit angka!");
    } else {
        $(this).removeClass("is-invalid");
        $("#tahunFeedback").html("");
    }
    $("input[name=tahun2]").val(this.value == "" ? 0 : parseInt(this.value) + 1);
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
