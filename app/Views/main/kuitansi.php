<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuitansi</title>
    <style>
        span.back {
            display: block;
            margin: 35px;
        }

        a.btn {
            text-decoration: none;
            background-color: #fff700;
            padding: 10px;
            border-radius: 5px;
            color: white;
        }

        a.btn:hover {
            background-color: #d6cf00;
        }

        img {
            width: 200px;
        }

        .container {
            margin: 30px;
            padding: 10px;
            border: 2px solid black;
        }

        .container header {
            text-align: center;
            padding: 0 30px;
            border-bottom: 2px solid black;
        }

        .container header h1 {
            margin-top: -2px;
        }

        .container header h4 {
            text-align: right;
            margin-top: -20px;
            margin-bottom: 3px;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 15px 5px;
        }

        ul.label {
            text-align: right;
        }

        .identitas {
            display: flex;
            justify-content: center;
        }

        .keterangan {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border: 2px solid rgba(0, 0, 0, .5);
            border-radius: 5px;
        }

        footer {
            display: flex;
            justify-content: space-between;
            padding: 20px 50px 20px 10px;
        }

        .tanda-tangan {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            height: 120px;
            text-align: center;
        }

        .notice {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        @media print {
            a {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php if ($role !== 'siswa') : ?>
        <span class="back">
            <a href="" class="btn btn-print">Print</a>
        </span>
    <?php endif ?>
    <div class="container">
        <header>
            <img src="/assets/img/logo.png" alt="Logo">
            <h1>Kuitansi Pembayaran Spp</h1>
            <h4><?= "No. " . sprintf("%03d", $pembayaran->id_pembayaran); ?></h4>
        </header>
        <main>
            <div class="identitas">
                <ul class="label">
                    <li>NISN / NIS</li>
                    <li>Nama Siswa</li>
                    <li>Kelas</li>
                    <li>Kompetensi Keahlian</li>
                    <li>Tanggal Pembayaran</li>
                </ul>
                <ul>
                    <li><?= "$pembayaran->nisn / $pembayaran->nis"; ?></li>
                    <li><?= $pembayaran->nama; ?></li>
                    <li><?= $pembayaran->nama_kelas; ?></li>
                    <li><?= $pembayaran->nama_jurusan; ?></li>
                    <li><?= tanggal($pembayaran->tgl_bayar); ?></li>
                </ul>
            </div>
            <h3 style="margin: 0 0 5px 5px;">Keterangan</h3>
            <div class="keterangan">
                <span>Pembayaran Spp Bulan <?= $pembayaran->bulan_dibayar; ?> Tahun Ajaran <?= $pembayaran->tahun_dibayar; ?></span>
                <span>Total: <?= "Rp. " . number_format($pembayaran->jumlah_bayar, 2, ',', '.'); ?></span>
            </div>
            <footer>
                <div class="notice">
                    <span>Perhatian!</span>
                    <span>Bukti Pembayaran harap disimpan dengan baik</span>
                </div>
                <div class="tanda-tangan">
                    <span>Bandung, <?= tanggal(date('Y-m-d', now("Asia/Jakarta"))); ?></span>
                    <span style="border-top: 2px solid black; padding-top: 5px; font-weight: bold;"><?= $role === 'siswa' ? $pembayaran->nama_petugas : $user->nama_petugas; ?></span>
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
</body>

</html>