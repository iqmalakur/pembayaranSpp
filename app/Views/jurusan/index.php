<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Jurusan</h1>
<a href="/jurusan/add" class="btn btn-primary mt-3 mb-4">Tambah Data</a>
<div class="mb-3">
    <input type="text" class="form-control" id="search-jurusan" placeholder="Cari Jurusan..." autofocus>
</div>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Jurusan</th>
            <th scope="col">Alias</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php foreach ($jurusan as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nama_jurusan; ?></td>
                <td><?= $item->alias; ?></td>
                <td>
                    <a href="/jurusan/edit/<?= $item->id_jurusan; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <form action="/jurusan/delete/<?= $item->id_jurusan; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="<?= $item->nama_jurusan; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
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