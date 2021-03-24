<?php foreach ($kelas as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td class="text-uppercase"><?= preg_replace("/$keyword/i", "<mark>$keyword</mark>", $item->nama_kelas); ?></td>
        <td class="text-capitalize"><?= preg_replace("/dan/i", "<span class=\"text-lowercase\">dan</span>", preg_replace("/$keyword/i", "<mark>$keyword</mark>", $item->nama_jurusan)); ?></td>
        <td>
            <a href="/kelas/edit/<?= $item->id_kelas; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
            <form action="/kelas/delete/<?= $item->id_kelas; ?>" method="POST" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <span class="delete btn btn-danger" data-item="<?= $item->nama_kelas; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
            </form>
        </td>
    </tr>
<?php endforeach ?>
<?php if (count($kelas) <= 0) : ?>
    <tr>
        <th scope="row" colspan="4">
            <h4 class="text-danger text-center">Data tidak ditemukan!</h4>
        </th>
    </tr>
<?php endif ?>