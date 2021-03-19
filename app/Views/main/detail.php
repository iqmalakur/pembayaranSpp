<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Detail Pembayaran Spp</h1>
<ul class="list-group">
    <li class="list-group-item">Petugas : <?= $pembayaran->nama_petugas; ?></li>
    <li class="list-group-item">NISN : <?= $pembayaran->nisn; ?></li>
    <li class="list-group-item">NIS : <?= $pembayaran->nis; ?></li>
    <li class="list-group-item">Nama : <?= $pembayaran->nama; ?></li>
    <li class="list-group-item">Kelas : <?= $pembayaran->nama_kelas; ?></li>
    <li class="list-group-item">Tanggal Bayar : <?= $pembayaran->tgl_bayar; ?></li>
    <li class="list-group-item">Spp : <?= "$pembayaran->bulan_dibayar - $pembayaran->tahun_dibayar"; ?></li>
    <li class="list-group-item">Jumlah Pembayaran : <?= "Rp. " . number_format($pembayaran->jumlah_bayar, 2, ',', '.'); ?></li>
</ul>
<form action="/pembayaran/print/" method="post" class="d-inline">
    <input type="hidden" name="id" value="<?= $pembayaran->id_pembayaran; ?>">
    <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak Bukti Pembayaran</button>
</form>
<a href="/pembayaran" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
<?= $this->endSection(); ?>