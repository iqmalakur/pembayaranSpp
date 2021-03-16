<?php foreach ($siswa as $index => $item) : ?>
    <tr class="data-siswa" style="cursor: pointer;">
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= $item->nisn; ?></td>
        <td><?= $item->nis; ?></td>
        <td><?= $item->nama; ?></td>
        <td><?= $item->nama_kelas; ?></td>
    </tr>
<?php endforeach ?>