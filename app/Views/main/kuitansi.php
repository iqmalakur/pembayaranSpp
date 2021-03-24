<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <title>Kuitansi</title>

    <style>
        img {
            width: 200px;
        }

        header h5 {
            margin-top: -20px;
        }

        ul {
            list-style: none;
        }

        ul li {
            line-height: 1.4;
        }

        footer {
            height: 165px;
        }

        @media print {
            a {
                display: none !important;
            }
        }
    </style>
</head>

<body class="overflow-visible">
    <?php if ($role !== 'siswa') : ?>
        <div class="text-end">
            <a href="" class="btn btn-primary btn-print mt-3 mx-5"><i class="bi bi-printer"></i> Print</a>
        </div>
    <?php endif ?>
    <div class="border border-2 border-dark my-3 mx-5 p-3">
        <header class="text-center border-bottom border-3 border-dark">
            <img src="/assets/img/logo.png" alt="Logo">
            <h2 class="fw-bold">Kuitansi Pembayaran Spp</h2>
            <h5 class="text-end me-5"><?= "No. " . sprintf("%03d", $pembayaran->id_pembayaran); ?></h5>
        </header>
        <main class="px-3 mt-2">
            <div class="row">
                <div class="col-6 d-flex justify-content-end p-2">
                    <ul class="text-end p-0">
                        <li>NISN / NIS</li>
                        <li>Nama Siswa</li>
                        <li>Kelas</li>
                        <li>Kompetensi Keahlian</li>
                        <li>Tanggal Pembayaran</li>
                    </ul>
                </div>
                <div class="col-6  d-flex justify-content-start p-2">
                    <ul class="p-0">
                        <li><?= "$pembayaran->nisn / $pembayaran->nis"; ?></li>
                        <li><?= $pembayaran->nama; ?></li>
                        <li><?= $pembayaran->nama_kelas; ?></li>
                        <li><?= $pembayaran->nama_jurusan; ?></li>
                        <li><?= tanggal($pembayaran->tgl_bayar); ?></li>
                    </ul>
                </div>
            </div>
            <h6 class="ps-2 fw-bold">Keterangan</h6>
            <div class="rounded border border-2 border-secondary p-2 d-flex justify-content-between">
                <span>Pembayaran Spp Bulan <?= $pembayaran->bulan_dibayar; ?> Tahun Ajaran <?= $pembayaran->tahun_dibayar; ?></span>
                <span>Total: <?= "Rp. " . number_format($pembayaran->jumlah_bayar, 2, ',', '.'); ?></span>
            </div>
            <footer class="d-flex justify-content-between px-2 pt-3">
                <div class="d-flex flex-column justify-content-center">
                    <span class="fw-bold">Perhatian!</span>
                    <span>Bukti Pembayaran harap disimpan dengan baik</span>
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <span>Bandung, <?= tanggal(date('Y-m-d', now("Asia/Jakarta"))); ?></span>
                    <span class="text-center border-top border-2 pt-2 border-dark fw-bold"><?= $role === 'siswa' ? $pembayaran->nama_petugas : $user->nama_petugas; ?></span>
                </div>
            </footer>
        </main>
    </div>

    <script>
        document.querySelector(".btn.btn-print").addEventListener("click", function(e) {
            e.preventDefault();
            window.print();
        })
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>