<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Spp</h1>
<a href="/spp/add" class="btn btn-primary mt-3 mb-4">Tambah Data</a>
<div class="mb-3">
    <input type="text" class="form-control" id="search-spp" placeholder="Cari Spp..." autofocus>
</div>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Angkatan</th>
            <th scope="col">Nominal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php foreach ($spp as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->angkatan; ?></td>
                <td><?= "Rp. " . number_format($item->nominal, 2, ',', '.'); ?></td>
                <td>
                    <a href="/spp/edit/<?= $item->id_spp; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <form action="/spp/delete/<?= $item->id_spp; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="Spp untuk Angkatan <?= $item->angkatan; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="text-center d-none" id="loader">
    <div class="text-muted">Sedang mengambil data...</div>
    <div class="spinner-border text-secondary mt-2" role="status">
        <span class="visually-hidden">Tunggu Sebentar...</span>
    </div>
</div>
<?= $this->endSection(); ?>