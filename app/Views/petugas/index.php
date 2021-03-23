<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Petugas</h1>
<a href="/petugas/add" class="btn btn-primary mt-3 mb-4">Tambah Data</a>
<div class="mb-3">
    <input type="text" class="form-control" id="search-petugas" placeholder="Cari Petugas..." autofocus>
</div>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Username</th>
            <th scope="col">Nama Petugas</th>
            <th scope="col">Level</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php foreach ($petugas as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->username; ?></td>
                <td><?= $item->nama_petugas; ?></td>
                <td><?= $item->level; ?></td>
                <td>
                    <a href="/petugas/edit/<?= $item->username; ?>" class="btn btn-primary <?= $item->username === 'admin' && $user->username !== 'admin' ? 'disabled' : ''; ?>" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <form action="/petugas/delete/<?= $item->username; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger <?= $item->username == 'admin' || $item->username == $user->username ? 'disabled' : ''; ?>" data-item="<?= $item->nama_petugas; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
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