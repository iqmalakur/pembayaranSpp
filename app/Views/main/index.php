<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<?php if ($loginStatus) : ?>
    <span id="login-success"></span>
<?php endif ?>
<h1 class="title text-center">Dashboard</h1>
<?= $this->endSection(); ?>