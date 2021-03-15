<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Siswa</h1>
<a href="/siswa/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NINS</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $i => $s) : ?>
            <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td><?= $s->nisn; ?></td>
                <td><?= $s->nis; ?></td>
                <td><?= $s->nama; ?></td>
                <td><?= $s->nama_kelas; ?></td>
                <td>
                    <a href="/siswa/detail/<?= $s->nisn; ?>" class="btn btn-success">Detail</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>