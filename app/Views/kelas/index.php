<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Kelas</h1>
<a href="/kelas/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Kelas</th>
            <th scope="col">Kompetensi Keahlian</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kelas as $i => $k) : ?>
            <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td><?= $k->nama_kelas; ?></td>
                <td><?= $k->nama_jurusan; ?></td>
                <td>
                    <a href="/kelas/edit/<?= $k->id_kelas; ?>" class="btn btn-primary">Ubah</a>
                    <form action="/kelas/delete/<?= $k->id_kelas; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="<?= $k->nama_kelas; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>