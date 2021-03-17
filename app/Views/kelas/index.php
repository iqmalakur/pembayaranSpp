<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Kelas</h1>
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
        <?php foreach ($kelas as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nama_kelas; ?></td>
                <td><?= $item->nama_jurusan; ?></td>
                <td>
                    <a href="/kelas/edit/<?= $item->id_kelas; ?>" class="btn btn-primary">Ubah</a>
                    <form action="/kelas/delete/<?= $item->id_kelas; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="<?= $item->nama_kelas; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>