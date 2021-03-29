<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <style>
        @media print {
            body {
                padding: 0;
            }
        }
    </style>
</head>

<body class="p-5">
    <h2 class="fw-bold text-center mt-4 mb-5">Laporan Pembayaran Spp Tahun <?= $tahun; ?></h2>
    <table class="table table-striped mt-4 table-bordered">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tanggal</th>
                <th scope="col">NISN</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Kelas</th>
                <th scope="col">Spp</th>
                <th scope="col">Nominal</th>
            </tr>
        </thead>
        <tbody id="container-cari">
            <?php if ($pembayaran) : ?>
                <?php foreach ($pembayaran as $index => $item) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1; ?></th>
                        <td><?= $item->tgl_bayar; ?></td>
                        <td><?= $item->nisn; ?></td>
                        <td><?= $item->nama; ?></td>
                        <td><?= $item->nama_kelas; ?></td>
                        <td><?= getBulan($item->bulan_dibayar) . " - $item->tahun_dibayar"; ?></td>
                        <td><?= "Rp. " . number_format($item->jumlah_bayar, 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <th scope="row" colspan="6" class="text-end">Total</th>
                    <th scope="row"><?= "Rp. " . number_format($total, 2, ',', '.'); ?></th>
                </tr>
            <?php else : ?>
                <tr>
                    <th scope="row" colspan="7" class="text-center">Tidak ada data</th>
                </tr>
            <?php endif ?>
        </tbody>
    </table>

    <script>
        window.print();

        window.onafterprint = function() {
            window.close();
        }
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>