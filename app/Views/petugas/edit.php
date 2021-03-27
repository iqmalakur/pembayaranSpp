<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<h1 class="text-center mb-5">Ubah Data Petugas</h1>
<form action="/petugas/update" method="POST">
    <?= csrf_field(); ?>
    <input type="hidden" name="username" value="<?= $petugas->username; ?>">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="<?= $petugas->username; ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="editPassword" class="form-label">Password</label>
        <input type="password" name="editPassword" class="form-control <?= isset($errors['editPassword']) ? 'is-invalid' : ''; ?>" id="editPassword" placeholder="Isi jika Password akan diganti">
        <div id="editPasswordFeedback" class="invalid-feedback">
            <?= isset($errors['editPassword']) ? $errors['editPassword'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="repeatPassword" class="form-label">Ulangi Password</label>
        <input type="password" name="repeatPassword" class="form-control <?= isset(session()->wrongPassword) ? 'is-invalid' : ''; ?>" id="repeatPassword" placeholder="Isi jika Password akan diganti">
        <div id="passwordFeedback" class="invalid-feedback">
            <?= isset(session()->wrongPassword) ? "Password tidak sama! Mohon ulangi password dengan benar!" : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="nama_petugas" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control text-capitalize <?= isset($errors['nama_petugas']) ? 'is-invalid' : ''; ?>" id="nama_petugas" value="<?= old('nama_petugas') ? old('nama_petugas') : $petugas->nama_petugas; ?>">
        <div id="nama_petugasFeedback" class="invalid-feedback">
            <?= isset($errors['nama_petugas']) ? $errors['nama_petugas'] : ''; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select class="form-select" id="level" name="level" <?= $petugas->username == $user->username || $user->username !== 'admin' ? 'disabled' : ''; ?>>
            <?php if (old('level')) : ?>
                <option value="admin" <?= old('level') == 'admin' ? 'selected' : ''; ?>>admin</option>
                <option value="petugas" <?= old('level') == 'petugas' ? 'selected' : ''; ?>>petugas</option>
            <?php else : ?>
                <option value="admin" <?= $petugas->level == 'admin' ? 'selected' : ''; ?>>admin</option>
                <option value="petugas" <?= $petugas->level == 'petugas' ? 'selected' : ''; ?>>petugas</option>
            <?php endif ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Ubah</button>
    <a href="/petugas" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Kembali</a>
</form>
<?= $this->endSection(); ?>