<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="text-center mb-5">Tambah Data Siswa</h1>
<form action="/siswa/save" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3 row">
        <div class="col-md-6">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control <?= isset($errors['nisn']) ? 'is-invalid' : ''; ?>" id="nisn" value="<?= old('nisn') ? old('nisn') : ''; ?>" autofocus>
            <div id="nisnFeedback" class="invalid-feedback">
                <?= isset($errors['nisn']) ? $errors['nisn'] : ''; ?>
            </div>
        </div>
        <div class="col-md-6">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control <?= isset($errors['nis']) ? 'is-invalid' : ''; ?>" id="nis" value="<?= old('nis') ? old('nis') : ''; ?>">
            <div id="nisFeedback" class="invalid-feedback">
                <?= isset($errors['nis']) ? $errors['nis'] : ''; ?>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control text-capitalize <?= isset($errors['nama']) ? 'is-invalid' : ''; ?>" id="nama" value="<?= old('nama') ? old('nama') : ''; ?>">
        <div id="namaFeedback" class="invalid-feedback">
            <?= isset($errors['nama']) ? $errors['nama'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="id_kelas" class="form-label">Kelas</label>
        <select class="form-select" id="id_kelas" name="id_kelas">
            <?php foreach ($kelas as $item) : ?>
                <option value="<?= $item->id_kelas; ?>" <?= old('id_kelas') == $item->id_kelas ? 'selected' : ''; ?>><?= $item->nama_kelas; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : ''; ?>" id="alamat" rows="3" name="alamat"><?= old('alamat') ? old('alamat') : ''; ?></textarea>
        <div id="alamatFeedback" class="invalid-feedback">
            <?= isset($errors['alamat']) ? $errors['alamat'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="no_telp" class="form-label">No. Telepon</label>
        <input type="number" name="no_telp" class="form-control <?= isset($errors['no_telp']) ? 'is-invalid' : ''; ?>" id="no_telp" value="<?= old('no_telp') ? old('no_telp') : ''; ?>">
        <div id="no_telpFeedback" class="invalid-feedback">
            <?= isset($errors['no_telp']) ? $errors['no_telp'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="id_spp" class="form-label">SPP</label>
        <select class="form-select" id="id_spp" name="id_spp">
            <?php foreach ($spp as $item) : ?>
                <option value="<?= $item->id_spp; ?>" <?= old('id_spp') == $item->id_spp ? 'selected' : ''; ?>><?= $item->tahun_ajaran . " | Rp " . number_format($item->nominal, 2, ',', '.'); ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/siswa" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
</form>
<?= $this->endSection(); ?>