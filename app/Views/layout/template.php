<?php
$this->include("layout/header");

if ($page != 'login') {
    $this->include("layout/navbar");
}

if ($role != 'siswa') {
    $this->include("layout/sidebar");
}

$this->renderSection("content");
$this->include("layout/footer");
