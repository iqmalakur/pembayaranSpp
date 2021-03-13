<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Spp</h1>
<a href="/spp/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Kompetensi Keahlian</th>
            <th scope="col">Nominal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($spp as $i => $s) : ?>
            <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td><?= $s->nama_jurusan; ?></td>
                <td><?= $s->nominal; ?></td>
                <td>
                    <a href="/spp/edit/<?= $s->id_spp; ?>" class="btn btn-primary">Ubah</a>
                    <form action="/spp/delete/<?= $s->id_spp; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span id="delete" class="btn btn-danger" data-item="Spp untuk Kompetensi Keahlian <?= $s->nama_jurusan; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>