<?php foreach ($siswa as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= $item->nisn; ?></td>
        <td><?= $item->nis; ?></td>
        <td><?= $item->nama; ?></td>
        <td><?= $item->nama_kelas; ?></td>
        <td>
            <a href="/siswa/detail/<?= $item->nisn; ?>" class="btn btn-success" title="Detail"><i class="bi bi-clipboard-plus"></i></a>
        </td>
    </tr>
<?php endforeach ?>
<?php if (count($siswa) <= 0) : ?>
    <tr>
        <th scope="row" colspan="6">
            <h4 class="text-danger text-center">Data tidak ditemukan!</h4>
        </th>
    </tr>
<?php endif ?>