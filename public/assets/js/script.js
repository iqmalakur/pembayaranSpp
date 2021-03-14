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
if ((namaKelas = document.querySelector("input[name=nama_kelas]"))) {
    namaKelas.addEventListener("input", function () {
        namaKelas.value = namaKelas.value.toUpperCase();
    });
}

// Error Exists
let errorExists;
if ((errorExists = document.getElementById("error-exists"))) {
    Swal.fire({
        icon: "error",
        title: "Nama " + errorExists.dataset.title + " " + errorExists.dataset.item + " telah digunakan!",
    });
}

// Error Spp
let errorSpp;
if ((errorSpp = document.getElementById("error-spp"))) {
    Swal.fire({
        icon: "error",
        title: "Spp untuk Kompetensi Keahlian " + errorSpp.dataset.jurusan + " telah tersedia!",
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
