<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title">Siswa</h1>
<a href="/siswa/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NISN</th>
            <th scope="col">NIS</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siswa as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nisn; ?></td>
                <td><?= $item->nis; ?></td>
                <td><?= $item->nama; ?></td>
                <td><?= $item->nama_kelas; ?></td>
                <td>
                    <a href="/siswa/detail/<?= $item->nisn; ?>" class="btn btn-success">Detail</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>