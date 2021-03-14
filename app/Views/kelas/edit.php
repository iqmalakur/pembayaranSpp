<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Ubah Data Kelas</h1>
<form action="/kelas/update" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas; ?>">
    <div class="mb-3">
        <label for="nama_kelas" class="form-label">Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control <?= isset($errors['nama_kelas']) ? 'is-invalid' : ''; ?>" id="nama_kelas" value="<?= old('nama_kelas') ? old('nama_kelas') : $kelas->nama_kelas; ?>">
        <div id="nama_kelasFeedback" class="invalid-feedback">
            <?= isset($errors['nama_kelas']) ? $errors['nama_kelas'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
        <select class="form-select" id="kompetensi_keahlian" name="kompetensi_keahlian">
            <?php foreach ($jurusan as $j) : ?>
                <?php if (old('kompetensi_keahlian')) : ?>
                    <option value="<?= $j->id_jurusan; ?>" <?= old('kompetensi_keahlian') == $j->id_jurusan ? 'selected' : ''; ?>><?= $j->nama_jurusan; ?></option>
                <?php else : ?>
                    <option value="<?= $j->id_jurusan; ?>" <?= $j->id_jurusan == $kelas->kompetensi_keahlian ? 'selected' : ''; ?>><?= $j->nama_jurusan; ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Ubah Data</button>
    <a href="/kelas" class="btn btn-warning">Kembali</a>
</form>
<?= $this->endSection(); ?>