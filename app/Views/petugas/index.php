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
        <?php foreach ($petugas as $i => $p) : ?>
            <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td><?= $p->username; ?></td>
                <td><?= $p->nama_petugas; ?></td>
                <td><?= $p->level; ?></td>
                <td>
                    <a href="/petugas/edit/<?= $p->username; ?>" class="btn btn-primary <?= $p->username === 'admin' && $user->username !== 'admin' ? 'disabled' : ''; ?>">Ubah</a>
                    <form action="/petugas/delete/<?= $p->username; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span id="delete" class="btn btn-danger <?= $p->username == 'admin' || $p->username == $user->username ? 'disabled' : ''; ?>" data-item="<?= $p->nama_petugas; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>