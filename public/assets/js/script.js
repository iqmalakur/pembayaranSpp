// Konfirmasi Hapus Data
let konfirmasiHapus;
if ((konfirmasiHapus = document.querySelectorAll("span#delete"))) {
    konfirmasiHapus.forEach((item) => {
        item.addEventListener("click", function () {
            Swal.fire({
                title: "Anda yakin akan Menghapus?",
                text: item.dataset.item + " akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus data ini!",
                cancelButtonText: "Jangan hapus data!",
            }).then((result) => {
                if (result.isConfirmed) {
                    item.parentElement.submit();
                }
            });
        });
    });
}

// Field Username
let username;
if ((username = document.querySelector("input[name=username]"))) {
    username.addEventListener("input", function () {
        username.value = username.value.toLowerCase();
    });
}

// Controller Jurusan
let alias;
if ((alias = document.querySelector("input[name=alias]"))) {
    alias.addEventListener("input", function () {
        alias.value = alias.value.toUpperCase();
    });
}

// Controller Kelas
let namaKelas;
if ((namaKelas = document.querySelector("input[name=nama_kelas]")) || (namaKelas = document.getElementById("select-kelas"))) {
    namaKelas.addEventListener("input", function () {
        namaKelas.value = namaKelas.value.toUpperCase();
    });
}

// Controller Spp
let tahun;
if ((tahun = document.querySelector("input[name=tahun]"))) {
    tahun.addEventListener("input", function () {
        if (parseInt(tahun.value) < 1000 || parseInt(tahun.value) > 9999 || tahun.value == "") {
            tahun.classList.add("is-invalid");
            document.getElementById("tahunFeedback").innerHTML = "Tahun terdiri dari 4 digit angka!";
        } else {
            tahun.classList.remove("is-invalid");
            document.getElementById("tahunFeedback").innerHTML = "";
        }
        document.querySelector("input[name=tahun2]").value = tahun.value == "" ? 0 : parseInt(tahun.value) + 1;
    });
}

// Message
let message;
if ((message = document.getElementById("message"))) {
    Swal.fire({
        icon: message.dataset.icon,
        title: message.dataset.title,
        text: message.dataset.text,
    });
}

// Alert Berhasil
let succesInfo;
if ((succesInfo = document.getElementById("success-info"))) {
    // Swal.fire({
    //     icon: "success",
    //     title: "Berhasil " + succesInfo.dataset.title + " data",
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
        title: "Berhasil " + succesInfo.dataset.title + " data",
    });
}

// Alert Berhasil Login
let login;
if ((login = document.getElementById("login-success"))) {
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
