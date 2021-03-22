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

// Sidebar
$("#content aside span i").click(function () {
    if (window.innerWidth <= 768) {
        let height = window.innerWidth <= 400 ? 50 : 64;
        $(this).parent().toggleClass("expand");
        $("#content aside span").hasClass("expand") ? $("aside#sidebar").css("height", "354px") : $("aside#sidebar").css("height", height + "px");
    } else {
        $(this).parent().toggleClass("aktif");
        $("#content").toggleClass("sidebar-collapse");

        setTimeout(
            () => {
                $(".list-text").toggleClass("d-none");
            },
            $(".list-text").hasClass("d-none") ? 350 : 25
        );

        setTimeout(
            () => {
                $("#sidebar-list a").toggleClass("text-center");
            },
            $("#sidebar-list a").hasClass("text-center") ? 0 : 425
        );

        setTimeout(() => {
            $("main").toggleClass("px-5");
        }, 250);

        $.ajax({
            url: "/sidebar",
            type: "POST",
            data: { sidebar: $("#content").hasClass("sidebar-collapse") ? true : false },
        });
    }
});

sidebarTop();
$(window).resize(sidebarTop);

function sidebarTop() {
    if (window.innerWidth <= 768) {
        let height = window.innerWidth <= 400 ? 50 : 64;
        $("aside#sidebar").css("height", height + "px");
        $("aside nav").removeClass("px-2");
        $(".login-container").removeClass("container");

        if ($("#content").hasClass("sidebar-collapse")) {
            $(".list-text").removeClass("d-none");
            $("#content aside span").removeClass("aktif");
        }
    } else {
        $("aside#sidebar").css("height", "auto");
        $("aside nav").addClass("px-2");
        $(".login-container").addClass("container");
        $("#content aside span").removeClass("expand");

        if ($("#content").hasClass("sidebar-collapse")) {
            $(".list-text").addClass("d-none");
            $("#content aside span").addClass("aktif");
        }
    }
}

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

$("#btn-cari-siswa").click(function () {
    setTimeout(() => {
        $("#cari-siswa").focus();
    }, 500);
});
