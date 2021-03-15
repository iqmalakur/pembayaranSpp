<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Tambah Data Spp</h1>
<form action="/spp/save" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3 row">
        <label for="tahun" class="form-label">Tahun Ajaran</label>
        <div class="col-6">
            <input type="number" min="1900" max="2100" name="tahun" class="form-control <?= isset($errors['tahun']) ? 'is-invalid' : ''; ?>" id="tahun" value="<?= old('tahun') ? old('tahun') : date('Y'); ?>">
            <div id="tahunFeedback" class="invalid-feedback">
                <?= isset($errors['tahun']) ? $errors['tahun'] : ''; ?>
            </div>
        </div>
        <div class="col-6">
            <input type="text" name="tahun2" class="form-control" value="<?= old('tahun') ? old('tahun') + 1 : date('Y') + 1; ?>" readonly>
        </div>
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