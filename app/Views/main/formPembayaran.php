<form action="/bayar" method="post">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">NISN Siswa</label>
        <div class="input-group">
            <input type="text" class="form-control" name="nisn" placeholder="Terisi otomatis" id="pembayaran-siswa" readonly>
            <input type="text" class="form-control" id="pembayaran-siswa-info" readonly>
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#siswaModal">Cari Siswa</button>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Id Spp</label>
        <div class="input-group">
            <input type="text" class="form-control" name="id_spp" placeholder="Terisi otomatis" id="pembayaran-spp" readonly>
            <input type="text" class="form-control" id="pembayaran-spp-info" readonly>
        </div>
    </div>
    <div class="mb-3">
        <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('Y-m-d'); ?>">
    </div>
    <div class="mb-3">
        <label for="bulan_dibayar" class="form-label">Bulan Dibayar</label>
        <select class="form-select" aria-label="Default select example">
            <option value="Jan" <?= $bulan == "Jan" ? "selected" : ""; ?>>Januari</option>
            <option value="Feb" <?= $bulan == "Feb" ? "selected" : ""; ?>>Februari</option>
            <option value="Mar" <?= $bulan == "Mar" ? "selected" : ""; ?>>Maret</option>
            <option value="Apr" <?= $bulan == "Apr" ? "selected" : ""; ?>>April</option>
            <option value="May" <?= $bulan == "May" ? "selected" : ""; ?>>Mei</option>
            <option value="Jun" <?= $bulan == "Jun" ? "selected" : ""; ?>>Juni</option>
            <option value="Jul" <?= $bulan == "Jul" ? "selected" : ""; ?>>Juli</option>
            <option value="Aug" <?= $bulan == "Aug" ? "selected" : ""; ?>>Agustus</option>
            <option value="Sep" <?= $bulan == "Sep" ? "selected" : ""; ?>>September</option>
            <option value="Oct" <?= $bulan == "Oct" ? "selected" : ""; ?>>Oktober</option>
            <option value="Nov" <?= $bulan == "Nov" ? "selected" : ""; ?>>November</option>
            <option value="Dec" <?= $bulan == "Dec" ? "selected" : ""; ?>>Desember</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Tahun Dibayar</label>
        <input type="text" class="form-control" id="pembayaran-tahun" name="tahun_dibayar" placeholder="Terisi otomatis" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Jumlah Bayar</label>
        <input type="text" class="form-control" id="pembayaran-jumlah" name="jumlah_bayar" placeholder="Terisi otomatis" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<!-- Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="siswaModalLabel">Cari Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>