<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center">Pembayaran Spp</h1>

<!-- Form Pembayaran -->
<form action="/bayar" method="post">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">NISN Siswa</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nisn" placeholder="Terisi otomatis" id="pembayaran-siswa" value="<?= $sppSiswa ? $sppSiswa->nisn : ''; ?>" readonly>
            <input type="text" class="form-control" id="pembayaran-siswa-info" value="<?= $sppSiswa ? "$sppSiswa->nama - $sppSiswa->nama_kelas" : ''; ?>" readonly>
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#siswaModal" title="Cari Siswa"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Id Spp</label>
        <div class="input-group">
            <input type="text" class="form-control" name="id_spp" placeholder="Terisi otomatis" id="pembayaran-spp" value="<?= $sppSiswa ? $sppSiswa->id_spp : ''; ?>" readonly>
            <input type="text" class="form-control" id="pembayaran-spp-info" readonly>
        </div>
    </div>
    <div class="mb-3">
        <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('Y-m-d'); ?>">
    </div>
    <div class="mb-3">
        <label for="bulan_dibayar" class="form-label">Bulan Dibayar</label>
        <select class="form-select" aria-label="Default select example" name="bulan_dibayar">
            <option value="Januari" <?= $bulan == "Jan" ? "selected" : ""; ?>>Januari</option>
            <option value="Februari" <?= $bulan == "Feb" ? "selected" : ""; ?>>Februari</option>
            <option value="Maret" <?= $bulan == "Mar" ? "selected" : ""; ?>>Maret</option>
            <option value="April" <?= $bulan == "Apr" ? "selected" : ""; ?>>April</option>
            <option value="Mei" <?= $bulan == "May" ? "selected" : ""; ?>>Mei</option>
            <option value="Juni" <?= $bulan == "Jun" ? "selected" : ""; ?>>Juni</option>
            <option value="Juli" <?= $bulan == "Jul" ? "selected" : ""; ?>>Juli</option>
            <option value="Agustus" <?= $bulan == "Aug" ? "selected" : ""; ?>>Agustus</option>
            <option value="September" <?= $bulan == "Sep" ? "selected" : ""; ?>>September</option>
            <option value="Oktober" <?= $bulan == "Oct" ? "selected" : ""; ?>>Oktober</option>
            <option value="November" <?= $bulan == "Nov" ? "selected" : ""; ?>>November</option>
            <option value="Desember" <?= $bulan == "Dec" ? "selected" : ""; ?>>Desember</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun Dibayar</label>
        <input type="text" class="form-control" id="pembayaran-tahun" name="tahun_dibayar" placeholder="Terisi otomatis" value="<?= $sppSiswa ? $sppSiswa->tahun : ''; ?>" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Bayar</label>
        <input type="text" class="form-control" id="pembayaran-jumlah" name="jumlah_bayar" placeholder="Terisi otomatis" value="<?= $sppSiswa ? $sppSiswa->nominal : ''; ?>" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Tabel Pembayaran -->
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NISN</th>
            <th scope="col">Petugas</th>
            <th scope="col">Tanggal Bayar</th>
            <th scope="col">Spp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="data-pembayaran">
        <?php foreach ($pembayaran as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nisn; ?></td>
                <td><?= $item->nama_petugas; ?></td>
                <td><?= $item->tgl_bayar; ?></td>
                <td><?= "$item->bulan_dibayar - $item->tahun_dibayar"; ?></td>
                <td><a href="/<?= sprintf("%03d", $item->id_pembayaran); ?>" class="btn btn-success" title="Kwitansi" target="_blank"><i class="bi bi-receipt"></i></a></td>
            </tr>
        <?php endforeach ?>
        <?php if (!$pembayaran) : ?>
            <tr>
                <td colspan="6">
                    <h5 class="text-center text-danger">Pilih Siswa terlebih dahulu!</h5>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalLabel">Cari Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="cari-siswa" placeholder="Masukan NISN / NIS / Kelas / Nama Siswa">
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NISN</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                        </tr>
                    </thead>
                    <tbody id="container-cari">
                        <?php foreach ($siswa as $index => $item) : ?>
                            <tr class="data-siswa" style="cursor: pointer;">
                                <th scope="row"><?= $index + 1; ?></th>
                                <td><?= $item->nisn; ?></td>
                                <td><?= $item->nis; ?></td>
                                <td><?= $item->nama; ?></td>
                                <td><?= $item->nama_kelas; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="text-center d-none" id="loader">
                    <div class="spinner-border text-secondary mt-2" role="status">
                        <span class="visually-hidden">Tunggu Sebentar...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>