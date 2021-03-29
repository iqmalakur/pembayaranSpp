<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="text-center mb-5">Ubah Data Spp</h1>
<form action="/spp/update" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_spp" value="<?= $spp->id_spp; ?>">
    <div class="mb-3">
        <label class="form-label">Tahun Ajaran</label>
        <input type="text" value="<?= $spp->tahun_ajaran; ?>" name="tahun" class="form-control" readonly>
    </div>
    <div class=" mb-3">
        <label for="nominal" class="form-label">Nominal</label>
        <input type="text" name="nominal" class="form-control <?= isset($errors['nominal']) ? 'is-invalid' : ''; ?>" id="nominal" value="<?= old('nominal') ? old('nominal') : $spp->nominal; ?>">
        <div id="nominalFeedback" class="invalid-feedback">
            <?= isset($errors['nominal']) ? $errors['nominal'] : ''; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Ubah</button>
    <a href="/spp" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
</form>
<?= $this->endSection(); ?>