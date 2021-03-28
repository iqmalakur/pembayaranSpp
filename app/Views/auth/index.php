<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="card">
    <div class="card-header pt-4 bg-nav">
        <h1 class="card-title text-center title mb-3">Login</h1>
    </div>
    <div class="card-body p-4 bg-content">
        <?php if (isset($errors['login-fail'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username atau Password <strong>salah!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <form method="POST" action="/login">
            <?= csrf_field(); ?>
            <div class="mb-3">
                <label for="username" class="form-label"><i class="bi bi-person-fill"></i> Username</label>
                <input type="text" name="username" class="form-control text-lowercase <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" value="<?= old('username') ? old('username') : ''; ?>" autofocus>
                <div id="usernameFeedback" class="invalid-feedback">
                    <?= isset($errors['username']) ? $errors['username'] : ''; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
                <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password">
                <div id="passwordFeedback" class="invalid-feedback">
                    <?= isset($errors['password']) ? $errors['password'] : ''; ?>
                </div>
            </div>
            <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div> -->
            <div class="mb-1">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>