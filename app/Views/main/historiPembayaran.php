<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">NISN</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Tanggal Bayar</th>
            <th scope="col">Spp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pembayaran as $index => $item) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td><?= $item->nisn; ?></td>
                <td><?= $item->nama; ?></td>
                <td><?= $item->nama_kelas; ?></td>
                <td><?= $item->tgl_bayar; ?></td>
                <td><?= "$item->bulan_dibayar - $item->tahun_dibayar"; ?></td>
                <td><a href="/pembayaran/detail/<?= $item->id_pembayaran; ?>" class="btn btn-success">Detail</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>