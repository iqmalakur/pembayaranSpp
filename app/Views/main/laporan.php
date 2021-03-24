<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1 class="text-center">Laporan Pembayaran Spp</h1>
<a href="/laporan/<?= implode("-", explode("/", $spp[0]->tahun_dibayar)); ?>" class="btn btn-primary" target="_blank" id="print-laporan"><i class="bi bi-printer"></i> Print Laporan</a>
<div class="row mt-5">
    <label for="filter-laporan" class="col-sm-2 col-form-label">Laporan Tahun</label>
    <div class="col-sm-10">
        <select class="form-select" id="filter-laporan">
            <?php foreach ($spp as $item) : ?>
                <option value="<?= implode("-", explode("/", $item->tahun_dibayar)); ?>"><?= $item->tahun_dibayar; ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<table class="table table-hover table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Tanggal</th>
            <th scope="col">NISN</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Kelas</th>
            <th scope="col">Spp</th>
            <th scope="col">Nominal</th>
        </tr>
    </thead>
    <tbody id="container-cari">
        <?php if ($pembayaran) : ?>
            <?php foreach ($pembayaran as $index => $item) : ?>
                <tr>
                    <th scope="row"><?= $index + 1; ?></th>
                    <td><?= $item->tgl_bayar; ?></td>
                    <td><?= $item->nisn; ?></td>
                    <td><?= $item->nama; ?></td>
                    <td><?= $item->nama_kelas; ?></td>
                    <td><?= "$item->bulan_dibayar - $item->tahun_dibayar"; ?></td>
                    <td><?= "Rp. " . number_format($item->jumlah_bayar, 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <th scope="row" colspan="6" class="text-end">Total</th>
                <th scope="row"><?= "Rp. " . number_format($total, 2, ',', '.'); ?></th>
            </tr>
        <?php else : ?>
            <tr>
                <th scope="row" colspan="7" class="text-center">Tidak ada data</th>
            </tr>
        <?php endif ?>
    </tbody>
</table>
<div class="text-center d-none" id="loader">
    <div class="text-muted">Sedang mengambil data...</div>
    <div class="spinner-border text-secondary mt-2" role="status">
        <span class="visually-hidden">Tunggu Sebentar...</span>
    </div>
</div>
<?= $this->endSection(); ?>