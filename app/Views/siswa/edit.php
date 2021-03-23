<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Ubah Data Siswa</h1>
<form action="/siswa/update" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label class="form-label">NISN</label>
        <input type="text" name="nisn" class="form-control" value="<?= $siswa->nisn; ?>" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">NIS</label>
        <input type="text" name="nis" class="form-control" value="<?= $siswa->nis; ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control text-capitalize <?= isset($errors['nama']) ? 'is-invalid' : ''; ?>" id="nama" value="<?= old('nama') ? old('nama') : $siswa->nama; ?>">
        <div id="namaFeedback" class="invalid-feedback">
            <?= isset($errors['nama']) ? $errors['nama'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="id_kelas" class="form-label">Kelas</label>
        <select class="form-select" id="id_kelas" name="id_kelas">
            <?php foreach ($kelas as $item) : ?>
                <?php if (old('id_kelas')) : ?>
                    <option value="<?= $item->id_kelas; ?>" <?= old('id_kelas') == $item->id_kelas ? 'selected' : ''; ?>><?= $item->nama_kelas; ?></option>
                <?php else : ?>
                    <option value="<?= $item->id_kelas; ?>" <?= $siswa->id_kelas == $item->id_kelas ? 'selected' : ''; ?>><?= $item->nama_kelas; ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" rows="3" name="alamat"><?= old('alamat') ? old('alamat') : $siswa->alamat; ?></textarea>
        <div id="alamatFeedback" class="invalid-feedback">
            <?= isset($errors['alamat']) ? $errors['alamat'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="no_telp" class="form-label">No. Telepon</label>
        <input type="text" name="no_telp" class="form-control <?= isset($errors['no_telp']) ? 'is-invalid' : ''; ?>" id="no_telp" value="<?= old('no_telp') ? old('no_telp') : $siswa->no_telp; ?>">
        <div id="no_telpFeedback" class="invalid-feedback">
            <?= isset($errors['no_telp']) ? $errors['no_telp'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">SPP</label>
        <input type="text" class="form-control" value="<?= $spp->angkatan . " | Rp " . number_format($spp->nominal, 2, ',', '.'); ?>" readonly>
    </div>
    <button type="submit" class="btn btn-success">Ubah</button>
    <a href="/siswa" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
</form>
<?= $this->endSection(); ?>