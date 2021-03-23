<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<?php if ($loginStatus) : ?>
    <span id="login-success"></span>
<?php endif ?>
<h1 class="title text-center">Dashboard</h1>

<div class="row my-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Pembayaran
            </div>
            <div class="card-body">
                <h1 class="card-title"><i class="bi bi-cash-stack"></i> <?= $countPembayaran; ?></h1>
                <a href="/pembayaran" class="btn btn-primary">Entri Pembayaran Spp <i class="bi bi-arrow-right-short"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Kelas
            </div>
            <div class="card-body">
                <h1 class="card-title"><i class="bi bi-building"></i> <?= $kelas; ?></h1>
                <a href="/kelas" class="btn btn-primary">Selengkapnya <i class="bi bi-arrow-right-short"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Siswa
            </div>
            <div class="card-body">
                <h1 class="card-title"><i class="bi bi-people-fill"></i> <?= $siswa; ?></h1>
                <a href="/siswa" class="btn btn-primary">Selengkapnya <i class="bi bi-arrow-right-short"></i></a>
            </div>
        </div>
    </div>
</div>

<textarea class="d-none" id="pembayaran"><?= $pembayaran; ?></textarea>

<div class="row justify-content-center mt-5">
    <div class="col-10">
        <canvas id="canvasPembayaran"></canvas>
    </div>
</div>
<?= $this->endSection(); ?>