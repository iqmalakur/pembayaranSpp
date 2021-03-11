<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container justify-content-center d-flex login-container">
    <div class="card shadow-lg">
        <div class="card-body px-4">
            <h1 class="card-title text-center">Login</h1>
            <?php if (isset($errors['login-fail'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username atau Password <strong>salah!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <form method="POST" action="/login" class="mt-5 p-4">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" value="<?= old('username') ? old('username') : ''; ?>">
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
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-3">Login</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>