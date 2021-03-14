<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Tambah Data Spp</h1>
<form action="/spp/save" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <?php
        $i = 0
        ?>
        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
        <select class="form-select" id="kompetensi_keahlian" name="kompetensi_keahlian">
            <?php foreach ($jurusan as $j) : ?>
                <?php if (old('kompetensi_keahlian')) : ?>
                    <option value="<?= $j->id_jurusan; ?>" <?= old('kompetensi_keahlian') == $j->id_jurusan ? 'selected' : ''; ?>><?= $j->nama_jurusan; ?></option>
                <?php else : ?>
                    <option value="<?= $j->id_jurusan; ?>" <?= $spp->cek($j->id_jurusan) ? 'disabled' : $i++; ?>><?= $j->nama_jurusan; ?></option>
                <?php endif ?>
            <?php endforeach ?>
            <?php if ($i == 0) : ?>
                <option value="null">Semua jurusan telah memiliki spp</option>
            <?php endif ?>
            <option value="tambahJurusan">Tambah Jurusan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nominal" class="form-label">Nominal</label>
        <input type="text" name="nominal" class="form-control <?= isset($errors['nominal']) ? 'is-invalid' : ''; ?>" id="nominal" value="<?= old('nominal') ? old('nominal') : ''; ?>">
        <div id="nominalFeedback" class="invalid-feedback">
            <?= isset($errors['nominal']) ? $errors['nominal'] : ''; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
    <a href="/spp" class="btn btn-warning">Kembali</a>
</form>
<?= $this->endSection(); ?>