<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h2 class="text-center">Identitas Siswa</h2>
<form>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">NISN</label>
            <input type="text" class="form-control" value="<?= $user->nisn; ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">NIS</label>
            <input type="text" class="form-control" value="<?= $user->nis; ?>" disabled>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" value="<?= $user->nama; ?>" disabled>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Kelas</label>
            <input type="text" class="form-control" value="<?= $user->nama_kelas; ?>" disabled>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kompetensi Keahlian</label>
            <input type="text" class="form-control" value="<?= $user->nama_jurusan; ?>" disabled>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea class="form-control" rows="3" disabled><?= $user->alamat; ?></textarea>
    </div>
</form>
<h2 class="text-center">Histori Pembayaran</h2>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Petugas</th>
            <th scope="col">Tanggal Bayar</th>
            <th scope="col">Spp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pembayaran as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nama_petugas; ?></td>
                <td><?= $item->tgl_bayar; ?></td>
                <td><?= "$item->bulan_dibayar - $item->tahun_dibayar"; ?></td>
                <td><a href="/<?= sprintf("%03d", $item->id_pembayaran); ?>" class="btn btn-success" title="Kuitansi" target="_blank"><i class="bi bi-receipt"></i></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection(); ?>