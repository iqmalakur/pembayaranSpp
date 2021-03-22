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

<div class="row align-items-center">
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Filter Diagram
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($spp as $index => $item) : ?>
                    <li class="list-group-item">
                        <input class="form-check-input me-1" id="list-<?= $index; ?>" type="checkbox" value="<?= $item->tahun_dibayar; ?>" checked>
                        <label for="list-<?= $index; ?>"><?= $item->tahun_dibayar; ?></label>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <textarea class="d-none"><?= $pembayaran; ?></textarea>
        <canvas id="pembayaranChart"></canvas>
    </div>
</div>
<?= $this->endSection(); ?>