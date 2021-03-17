<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Jurusan</h1>
<a href="/jurusan/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Jurusan</th>
            <th scope="col">Alias</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jurusan as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $item + 1; ?></th>
                <td><?= $item->nama_jurusan; ?></td>
                <td><?= $item->alias; ?></td>
                <td>
                    <a href="/jurusan/edit/<?= $item->id_jurusan; ?>" class="btn btn-primary">Ubah</a>
                    <form action="/jurusan/delete/<?= $item->id_jurusan; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="<?= $item->nama_jurusan; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>