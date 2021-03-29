<?php foreach ($siswa as $index => $item) : ?>
    <tr class="data-siswa" style="cursor: pointer;">
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= preg_replace("/$keyword/i", "<mark>$keyword</mark>", $item->nisn); ?></td>
        <td class="text-capitalize"><?= preg_replace("/$keyword/i", "<mark>$keyword</mark>", $item->nama); ?></td>
        <td class="text-uppercase"><?= preg_replace("/$keyword/i", "<mark>$keyword</mark>", $item->nama_kelas); ?></td>
        <td><?= preg_replace("/" . preg_replace("/\//", "\/", $keyword) . "/i", "<mark>$keyword</mark>", $item->tahun_ajaran); ?></td>
    </tr>
<?php endforeach ?>