<?php
$listText = session()->sidebar == "true" ? 'd-none' : '';
$link = session()->sidebar == "true" ? 'text-center' : '';
?>
<aside class="bg-nav shadow <?= session()->sidebar == "true" ? 'sidebar-collapse' : ''; ?>" id="sidebar">
    <nav class="list-group px-2">
        <span class="mb-3 mx-auto <?= session()->sidebar == "true" ? 'aktif' : ''; ?>" title="CTRL + ;"><i class="bi bi-arrow-left-circle"></i></span>
        <div id="sidebar-list">
            <a href="/" class="list-group-item list-group-item-action <?= $link; ?>" title="Dashboard">
                <i class="bi bi-clipboard-data"></i> <span class="list-text <?= $listText; ?>">Dashboard</span>
            </a>
            <a href="/pembayaran" class="list-group-item list-group-item-action <?= $link; ?>" title="Pembayaran Spp">
                <i class="bi bi-pencil-square"></i> <span class="list-text <?= $listText; ?>">Pembayaran Spp</span>
            </a>
            <?php if ($role == 'admin') : ?>
                <a href="/laporan" class="list-group-item list-group-item-action <?= $link; ?>" title="Laporan">
                    <i class="bi bi-file-text"></i> <span class="list-text <?= $listText; ?>">Laporan</span>
                </a>
                <a href="/siswa" class="list-group-item list-group-item-action <?= $link; ?>" title="Siswa">
                    <i class="bi bi-people-fill"></i> <span class="list-text <?= $listText; ?>">Siswa</span>
                </a>
                <a href="/petugas" class="list-group-item list-group-item-action <?= $link; ?>" title="Petugas">
                    <i class="bi bi-person-fill"></i> <span class="list-text <?= $listText; ?>">Petugas</span>
                </a>
                <a href="/spp" class="list-group-item list-group-item-action <?= $link; ?>" title="Spp">
                    <i class="bi bi-cash-stack"></i> <span class="list-text <?= $listText; ?>">Spp</span>
                </a>
                <a href="/kelas" class="list-group-item list-group-item-action <?= $link; ?>" title="Kelas">
                    <i class="bi bi-building"></i> <span class="list-text <?= $listText; ?>">Kelas</span>
                </a>
                <a href="/jurusan" class="list-group-item list-group-item-action <?= $link; ?>" title="Kompetensi Keahlian">
                    <i class="bi bi-tools"></i> <span class="list-text <?= $listText; ?>">Kompetensi Keahlian</span>
                </a>
            <?php endif ?>
        </div>
    </nav>
</aside>