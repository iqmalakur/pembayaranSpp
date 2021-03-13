<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Sweet Alert 2 CSS -->
    <link rel="stylesheet" href="/assets/package/dist/sweetalert2.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <title><?= $title; ?></title>
</head>

<body>

    <?php
    if ($controller != 'Auth') {
        echo $this->include('layout/navbar');

        if ($role != 'siswa') {
            echo $this->include("layout/admin");
        } else {
            echo $this->include("layout/siswa");
        }
    } else {
        $this->renderSection('content');
    }

    if (isset(session()->loginInfo)) {
        echo '<span id="login-info" data-login="' . session()->loginInfo . '"></span>';
    }

    if (isset(session()->successInfo)) {
        echo '<span id="success-info" data-title="' . session()->successInfo . '"></span>';
    }
    ?>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Sweet Alert 2 -->
    <script src="/assets/package/dist/sweetalert2.all.js"></script>

    <!-- Chart.js -->
    <script src="/assets/Chart.js-2.9.4/dist/Chart.js"></script>

    <!-- My JavaScript -->
    <script src="/assets/js/script.js"></script>
</body>

</html>