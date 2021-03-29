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