<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Tambah Data Spp</h1>
<form action="/spp/save" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
        <select class="form-select" id="kompetensi_keahlian" name="kompetensi_keahlian">
            <?php foreach ($jurusan as $j) : ?>
                <?php if (old('kompetensi_keahlian')) : ?>
                    <option value="<?= $j->id_jurusan; ?>" <?= old('kompetensi_keahlian') == $j->id_jurusan ? 'selected' : ''; ?>><?= $j->nama_jurusan; ?></option>
                <?php else : ?>
                    <option value="<?= $j->id_jurusan; ?>"><?= $j->nama_jurusan; ?></option>
                <?php endif ?>
            <?php endforeach ?>
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
<?php if (session()->exists) : ?>
    <span id="error-spp" data-jurusan="<?= session()->exists; ?>"></span>
<?php endif ?>
<?= $this->endSection(); ?>