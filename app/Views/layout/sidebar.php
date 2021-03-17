<aside class="bg-light">
    <nav class="list-group px-2">
        <a href="/" class="list-group-item list-group-item-action">Dashboard</a>
        <a href="/pembayaran" class="list-group-item list-group-item-action">Pembayaran Spp</a>
        <?php if ($role == 'admin') : ?>
            <a href="/siswa" class="list-group-item list-group-item-action">Siswa</a>
            <a href="/petugas" class="list-group-item list-group-item-action">Petugas</a>
            <a href="/spp" class="list-group-item list-group-item-action">Spp</a>
            <a href="/kelas" class="list-group-item list-group-item-action">Kelas</a>
            <a href="/jurusan" class="list-group-item list-group-item-action">Jurusan</a>
        <?php endif ?>
    </nav>
</aside>