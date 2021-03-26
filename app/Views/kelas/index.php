<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Kelas</h1>
<a href="/kelas/add" class="btn btn-primary mt-3 mb-4">Tambah Data</a>
<div class="mb-3">
    <input type="text" class="form-control" id="search-kelas" placeholder="Cari Kelas..." autofocus>
</div>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Kelas</th>
            <th scope="col">Kompetensi Keahlian</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php foreach ($kelas as $item) : ?>
            <tr>
                <th scope="row"><?= ++$number; ?></th>
                <td><?= $item->nama_kelas; ?></td>
                <td><?= $item->nama_jurusan; ?></td>
                <td>
                    <a href="/kelas/edit/<?= $item->id_kelas; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <form action="/kelas/delete/<?= $item->id_kelas; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="<?= $item->nama_kelas; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php if ($count > 5) : ?>
    <?= $pager->links('kelas', 'bootstrap_pagination'); ?>
<?php endif ?>
<div class="text-center d-none" id="loader">
    <div class="text-muted">Sedang mengambil data...</div>
    <div class="spinner-border text-secondary mt-2" role="status">
        <span class="visually-hidden">Tunggu Sebentar...</span>
    </div>
</div>
<?= $this->endSection(); ?>