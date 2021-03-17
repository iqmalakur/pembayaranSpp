<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Spp</h1>
<a href="/spp/add" class="btn btn-success">Tambah Data</a>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Tahun</th>
            <th scope="col">Nominal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($spp as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->tahun; ?></td>
                <td><?= "Rp " . number_format($item->nominal, 2, ',', '.'); ?></td>
                <td>
                    <a href="/spp/edit/<?= $item->id_spp; ?>" class="btn btn-primary">Ubah</a>
                    <form action="/spp/delete/<?= $item->id_spp; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="Spp untuk Kompetensi Keahlian <?= $s->tahun; ?>">Hapus</span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>