<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Data Spp</h1>
<a href="/spp/add" class="btn btn-primary my-3">Tambah Data</a>
<table class="table table-hover table-striped table-bordered">
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
                <td><?= "Rp. " . number_format($item->nominal, 2, ',', '.'); ?></td>
                <td>
                    <a href="/spp/edit/<?= $item->id_spp; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <form action="/spp/delete/<?= $item->id_spp; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <span class="delete btn btn-danger" data-item="Spp untuk Kompetensi Keahlian <?= $item->tahun; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>