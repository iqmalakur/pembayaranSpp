<?php foreach ($jurusan as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= $item->nama_jurusan; ?></td>
        <td><?= $item->alias; ?></td>
        <td>
            <a href="/jurusan/edit/<?= $item->id_jurusan; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
            <form action="/jurusan/delete/<?= $item->id_jurusan; ?>" method="POST" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <span class="delete btn btn-danger" data-item="<?= $item->nama_jurusan; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
            </form>
        </td>
    </tr>
<?php endforeach ?>
<?php if (count($jurusan) <= 0) : ?>
    <tr>
        <th scope="row" colspan="4">
            <h4 class="text-danger text-center">Data tidak ditemukan!</h4>
        </th>
    </tr>
<?php endif ?>