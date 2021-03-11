// Field Username
const username = document.querySelector("input[name=username]");
username.addEventListener("input", function () {
    username.value = username.value.toLowerCase();
});

const login = document.getElementById("login-success");

if (login != null) {
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
