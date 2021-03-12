// Field Username
let username;
if ((username = document.querySelector("input[name=username]"))) {
    username.addEventListener("input", function () {
        username.value = username.value.toLowerCase();
    });
}

// Alert Berhasil Login
let login;
if ((login = document.getElementById("login-success"))) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-right",
        showConfirmButton: false,
        timer: 3000,
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

// Alert Informasi Login
let loginInfo;
if ((loginInfo = document.getElementById("login-info"))) {
    let login = loginInfo.dataset.login;

    console.log(login);

    Swal.fire({
        icon: login ? "info" : "warning",
        title: login ? "Anda Telah Login!" : "Anda Belum Login!",
        text: login ? "" : "Silahkan Login terlebih dahulu!",
        timer: 3000,
        timerProgressBar: true,
    });
}
