<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="title text-center mb-5">Pembayaran Spp</h1>

<!-- Form Pembayaran -->
<form action="/bayar" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_spp" value="<?= $sppSiswa ? $sppSiswa->id_spp : ''; ?>" id="pembayaran-spp">
    <div class="mb-3">
        <label class="form-label">NISN Siswa</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nisn" placeholder="Terisi otomatis" id="pembayaran-siswa" value="<?= $sppSiswa ? $sppSiswa->nisn : ''; ?>" readonly>
            <input type="text" class="form-control" id="pembayaran-siswa-info" value="<?= $sppSiswa ? "$sppSiswa->nama - $sppSiswa->nama_kelas" : ''; ?>" readonly>
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#siswaModal" title="Cari Siswa" id="btn-cari-siswa"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="mb-3">
        <label for="bulan_dibayar" class="form-label">Bulan Dibayar</label>
        <select class="form-select" aria-label="Default select example" name="bulan_dibayar">
            <option value="0" <?= $bulan == "Jul" ? "selected" : ""; ?>>Juli</option>
            <option value="1" <?= $bulan == "Aug" ? "selected" : ""; ?>>Agustus</option>
            <option value="2" <?= $bulan == "Sep" ? "selected" : ""; ?>>September</option>
            <option value="3" <?= $bulan == "Oct" ? "selected" : ""; ?>>Oktober</option>
            <option value="4" <?= $bulan == "Nov" ? "selected" : ""; ?>>November</option>
            <option value="5" <?= $bulan == "Dec" ? "selected" : ""; ?>>Desember</option>
            <option value="6" <?= $bulan == "Jan" ? "selected" : ""; ?>>Januari</option>
            <option value="7" <?= $bulan == "Feb" ? "selected" : ""; ?>>Februari</option>
            <option value="8" <?= $bulan == "Mar" ? "selected" : ""; ?>>Maret</option>
            <option value="9" <?= $bulan == "Apr" ? "selected" : ""; ?>>April</option>
            <option value="10" <?= $bulan == "May" ? "selected" : ""; ?>>Mei</option>
            <option value="11" <?= $bulan == "Jun" ? "selected" : ""; ?>>Juni</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="pembayaran-tahun" class="form-label">Tahun Dibayar</label>
        <input type="text" class="form-control" id="pembayaran-tahun" placeholder="Terisi otomatis" name="tahun_dibayar" readonly value="<?= $sppSiswa ? $sppSiswa->angkatan : ''; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Bayar</label>
        <input type="text" class="form-control" id="pembayaran-jumlah" name="jumlah_bayar" placeholder="Terisi otomatis" value="<?= $sppSiswa ? $sppSiswa->nominal : ''; ?>" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Tabel Pembayaran -->
<table class="table table-hover table-striped table-bordered mt-5">
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
                <td><?= "$item->tahun_dibayar - $item->bulan_dibayar"; ?></td>
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
                    <input type="text" class="form-control" id="cari-siswa" placeholder="Masukan NISN / Kelas / Spp / Nama Siswa">
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Spp</th>
                        </tr>
                    </thead>
                    <tbody id="container-cari">
                        <?php foreach ($siswa as $index => $item) : ?>
                            <tr class="data-siswa" style="cursor: pointer;">
                                <th scope="row"><?= $index + 1; ?></th>
                                <td><?= $item->nisn; ?></td>
                                <td><?= $item->nama; ?></td>
                                <td><?= $item->nama_kelas; ?></td>
                                <td><?= $item->angkatan; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="text-center d-none" id="loader">
                    <div class="text-muted">Sedang mengambil data...</div>
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