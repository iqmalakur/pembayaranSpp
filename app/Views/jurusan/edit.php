<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1>Ubah Data Jurusan</h1>
<form action="/jurusan/update" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="id_jurusan" value="<?= $jurusan->id_jurusan; ?>">
    <div class="mb-3">
        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
        <input type="text" name="nama_jurusan" class="form-control <?= isset($errors['nama_jurusan']) ? 'is-invalid' : ''; ?>" id="nama_jurusan" value="<?= old('nama_jurusan') ? old('nama_jurusan') : $jurusan->nama_jurusan; ?>">
        <div id="nama_jurusanFeedback" class="invalid-feedback">
            <?= isset($errors['nama_jurusan']) ? $errors['nama_jurusan'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="alias" class="form-label">Alias</label>
        <input type="text" name="alias" class="form-control <?= isset($errors['alias']) ? 'is-invalid' : ''; ?>" id="alias" value="<?= old('alias') ? old('alias') : $jurusan->alias; ?>">
        <div id="aliasFeedback" class="invalid-feedback">
            <?= isset($errors['alias']) ? $errors['alias'] : ''; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Ubah Data</button>
    <a href="/jurusan" class="btn btn-warning">Kembali</a>
</form>
<?php if (session()->exists) : ?>
    <span id="error-exists" data-title="Jurusan" data-item="<?= old('nama_jurusan'); ?>"></span>
<?php endif ?>
<?= $this->endSection(); ?>