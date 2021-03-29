<?php foreach ($siswa as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= $item->nisn; ?></td>
        <td><?= $item->nama_petugas; ?></td>
        <td><?= $item->tgl_bayar; ?></td>
        <td><?= "$item->tahun_dibayar - $item->bulan_dibayar"; ?></td>
        <td><a href="/<?= sprintf("%03d", $item->id_pembayaran); ?>" class="btn btn-success" title="Kuitansi" target="_blank"><i class="bi bi-receipt"></i></a></td>
    </tr>
<?php endforeach ?>