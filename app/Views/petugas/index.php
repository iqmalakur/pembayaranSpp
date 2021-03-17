<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Petugas</h1>
<a href="/petugas/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Username</th>
            <th scope="col">Nama Petugas</th>
            <th scope="col">Level</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($petugas as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->username; ?></td>
                <td><?= $item->nama_petugas; ?></td>
                <td><?= $item->level; ?></td>
                <td>
                    <a href="/petugas/edit/<?= $item->username; ?>" class="btn btn-primary <?= $item->username === 'admin' && $user->username !== 'admin' ? 'disabled' : ''; ?>">Ubah</a>
                    <form action="/petugas/delete/<?= $item->username; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger <?= $item->username == 'admin' || $item->username == $user->username ? 'disabled' : ''; ?>" data-item="<?= $item->nama_petugas; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>