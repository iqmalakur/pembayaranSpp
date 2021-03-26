<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Siswa</h1>
<a href="/siswa/add" class="btn btn-primary mt-3 mb-4">Tambah Data</a>
<div class="mb-3">
    <input type="text" class="form-control" id="search-siswa" placeholder="Cari Siswa..." autofocus>
</div>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NISN</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Spp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php foreach ($siswa as $item) : ?>
            <tr>
                <th scope="row"><?= ++$number; ?></th>
                <td><?= $item->nisn; ?></td>
                <td><?= $item->nama; ?></td>
                <td><?= $item->nama_kelas; ?></td>
                <td><?= $item->angkatan; ?></td>
                <td>
                    <a href="/siswa/detail/<?= $item->nisn; ?>" class="btn btn-success" title="Detail"><i class="bi bi-clipboard-plus"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php if ($count > 5) : ?>
    <?= $pager->links('siswa', 'bootstrap_pagination'); ?>
<?php endif ?>
<div class="text-center d-none" id="loader">
    <div class="text-muted">Sedang mengambil data...</div>
    <div class="spinner-border text-secondary mt-2" role="status">
        <span class="visually-hidden">Tunggu Sebentar...</span>
    </div>
</div>
<?= $this->endSection(); ?>