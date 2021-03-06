<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="text-center mb-5">Tambah Data Petugas</h1>
<form action="/petugas/save" method="POST">
    <?= csrf_field(); ?>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control text-lowercase <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" value="<?= old('username') ? old('username') : ''; ?>" autofocus>
        <div id="usernameFeedback" class="invalid-feedback">
            <?= isset($errors['username']) ? $errors['username'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password">
        <div id="passwordFeedback" class="invalid-feedback">
            <?= isset($errors['password']) ? $errors['password'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="repeatPassword" class="form-label">Ulangi Password</label>
        <input type="password" name="repeatPassword" class="form-control <?= isset(session()->wrongPassword) ? 'is-invalid' : ''; ?>" id="repeatPassword">
        <div id="passwordFeedback" class="invalid-feedback">
            <?= isset(session()->wrongPassword) ? "Password tidak sama! Mohon ulangi password dengan benar!" : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="nama_petugas" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control text-capitalize <?= isset($errors['nama_petugas']) ? 'is-invalid' : ''; ?>" id="nama_petugas" value="<?= old('nama_petugas') ? old('nama_petugas') : ''; ?>">
        <div id="nama_petugasFeedback" class="invalid-feedback">
            <?= isset($errors['nama_petugas']) ? $errors['nama_petugas'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select class="form-select" id="level" name="level">
            <option value="admin" <?= old('level') == 'admin' ? 'selected' : ''; ?> <?= $user->username !== 'admin' ? 'disabled' : ''; ?>>admin</option>
            <option value="petugas" <?= old('level') == 'petugas' ? 'selected' : ''; ?>>petugas</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/petugas" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
</form>
<?= $this->endSection(); ?>