<main class="mx-4">
    <div class="row">
        <aside class="col-md-2 py-3 px-4 my-4 bg-dark bg-gradient">
            <h1 class="text-center text-light mt-5">Menu</h1>
            <ul class="d-flex justify-content-center">
                <li><a href="/" class="btn btn-outline-light">Dashboard</a></li>
                <li><a href="/pembayaran" class="btn btn-outline-light">Pembayaran Spp</a></li>
                <?php if ($role == 'admin') : ?>
                    <li><a href="/siswa" class="btn btn-outline-light">Siswa</a></li>
                    <li><a href="/petugas" class="btn btn-outline-light">Petugas</a></li>
                    <li><a href="/spp" class="btn btn-outline-light">Spp</a></li>
                    <li><a href="/kelas" class="btn btn-outline-light">Kelas</a></li>
                    <li><a href="/jurusan" class="btn btn-outline-light">Jurusan</a></li>
                <?php endif ?>
            </ul>
        </aside>
        <section class="col-md-10 my-4">
            <div class="container p-4">
                <?= $this->renderSection('content'); ?>
            </div>
        </section>
    </div>
</main>