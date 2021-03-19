<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Sweet Alert 2 CSS -->
    <link rel="stylesheet" href="/assets/package/dist/sweetalert2.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Layout CSS -->
    <?php if ($role === 'siswa') : ?>
        <link rel="stylesheet" href="/assets/css/siswa.css">
    <?php elseif ($controller !== 'Auth') : ?>
        <link rel="stylesheet" href="/assets/css/petugas.css">
    <?php endif ?>

    <title><?= $title; ?></title>
</head>

<body class="<?= $controller == 'Auth' ? 'bg-my' : 'bg-light'; ?>">

    <?php
    if ($controller != 'Auth') {
        echo $this->include('layout/navbar');
    }
    ?>
    <div id="content" class="<?= $controller == 'Auth' ? 'd-flex justify-content-center align-items-center' : ''; ?> <?= session()->sidebar == "true" ? 'sidebar-collapse' : ''; ?>">
        <?php
        if ($role != 'siswa' && $controller != 'Auth') {
            echo $this->include("layout/sidebar");
        }
        ?>
        <main class="container mb-5 <?= session()->sidebar == "true" ? '' : 'px-5'; ?> <?= $controller == 'Auth' ? 'login-container' : ''; ?>">
            <?= $this->renderSection('content'); ?>
        </main>

        <?php
        if (isset(session()->successInfo)) {
            echo '<span id="success-info" data-title="' . session()->successInfo . '"></span>';
        }

        if (session()->message) {
            echo '<span id="message" data-icon="' . session()->message['icon'] . '" data-title="' . session()->message['title'] . '" data-text="' . session()->message['text'] . '"></span>';
        }
        ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="/assets/package/dist/sweetalert2.all.js"></script>

    <!-- Chart.js -->
    <script src="/assets/Chart.js-2.9.4/dist/Chart.js"></script>

    <!-- My JavaScript -->
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/ajax.js"></script>
</body>

</html>