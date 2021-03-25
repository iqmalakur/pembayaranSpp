// Sidebar
// =======================================
sidebarTop();

// Event saat browser di resize
$(window).resize(sidebarTop);

// Event saat tombol panah pada sidebar di-klik
$("#content aside span i").click(sidebar);

// Event untuk mendeteksi shortcut sidebar (ctrl + ;)
$(document).keydown(function (event) {
    if (event.ctrlKey && event.keyCode == 59 && !event.shiftKey && !event.altKey) {
        sidebar();
    }
});

function sidebar() {
    if (window.innerWidth <= 768) {
        let height = window.innerWidth <= 400 ? 50 : 64;
        $("#content aside span").toggleClass("expand");
        $("#content aside span").hasClass("expand") ? $("aside#sidebar").css("height", "354px") : $("aside#sidebar").css("height", height + "px");
    } else {
        $("#content aside span").toggleClass("aktif");
        $("aside").toggleClass("sidebar-collapse");

        setTimeout(
            () => {
                $(".list-text").toggleClass("d-none");
            },
            $(".list-text").hasClass("d-none") ? 450 : 10
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
            data: { sidebar: $("aside").hasClass("sidebar-collapse") ? true : false },
        });
    }
}

function sidebarTop() {
    if (window.innerWidth <= 768) {
        let height = window.innerWidth <= 400 ? 50 : 64;
        $("aside#sidebar").css("height", height + "px");
        $("aside nav").removeClass("px-2");
        $(".login-container").removeClass("container");

        if ($("aside").hasClass("sidebar-collapse")) {
            $(".list-text").removeClass("d-none");
            $("#content aside span").removeClass("aktif");
        }
    } else {
        $("aside#sidebar").css("height", "auto");
        $("aside nav").addClass("px-2");
        $(".login-container").addClass("container");
        $("#content aside span").removeClass("expand");

        if ($("aside").hasClass("sidebar-collapse")) {
            $(".list-text").addClass("d-none");
            $("#content aside span").addClass("aktif");
        }
    }
}
// =======================================

// Validasi NISN
$("input[name=nisn]").on("input", function () {
    if (this.value.length < 10 || this.value.length > 10 || this.value == "") {
        $(this).addClass("is-invalid");
        $("#nisnFeedback").html("NISN harus terdiri dari 10 karakter!");
    } else {
        $(this).removeClass("is-invalid");
        $("#nisnFeedback").html("");
    }
});

// Validasi NIS
$("input[name=nis]").on("input", function () {
    if (this.value.length < 8 || this.value.length > 8 || this.value == "") {
        $(this).addClass("is-invalid");
        $("#nisFeedback").html("NIS harus terdiri dari 8 karakter!");
    } else {
        $(this).removeClass("is-invalid");
        $("#nisFeedback").html("");
    }
});

// Validasi tahun
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

// Membuat focus input pada modal halaman entri pembayaran
$("#btn-cari-siswa").click(function () {
    setTimeout(() => {
        $("#cari-siswa").focus();
    }, 500);
});
