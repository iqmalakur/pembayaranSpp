<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top ps-3">
    <a class="navbar-brand title" href="/">Sistem Pembayaran SPP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown text-center">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i> <?= $role == 'siswa' ? $user->nama : $user->nama_petugas; ?>
                </a>
                <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>