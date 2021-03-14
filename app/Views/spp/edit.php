<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Ubah Data Spp</h1>
<form action="/spp/update" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_spp" value="<?= $spp->id_spp; ?>">
    <div class="mb-3">
        <label class="form-label">Kompetensi Keahlian</label>
        <select class="form-select" disabled>
            <option value="<?= $spp->id_jurusan; ?>"><?= $spp->nama_jurusan; ?></option>
        </select>
    </div>
    <div class="mb-3">
        <label for="nominal" class="form-label">Nominal</label>
        <input type="text" name="nominal" class="form-control <?= isset($errors['nominal']) ? 'is-invalid' : ''; ?>" id="nominal" value="<?= old('nominal') ? old('nominal') : $spp->nominal; ?>">
        <div id="nominalFeedback" class="invalid-feedback">
            <?= isset($errors['nominal']) ? $errors['nominal'] : ''; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Ubah Data</button>
    <a href="/spp" class="btn btn-warning">Kembali</a>
</form>
<?= $this->endSection(); ?>