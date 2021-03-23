<?php foreach ($petugas as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= $item->username; ?></td>
        <td><?= $item->nama_petugas; ?></td>
        <td><?= $item->level; ?></td>
        <td>
            <a href="/petugas/edit/<?= $item->username; ?>" class="btn btn-primary <?= $item->username === 'admin' && $user->username !== 'admin' ? 'disabled' : ''; ?>" title="Ubah"><i class="bi bi-pencil"></i></a>
            <form action="/petugas/delete/<?= $item->username; ?>" method="POST" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <span class="delete btn btn-danger <?= $item->username == 'admin' || $item->username == $user->username ? 'disabled' : ''; ?>" data-item="<?= $item->nama_petugas; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
            </form>
        </td>
    </tr>
<?php endforeach ?>
<?php if (count($petugas) <= 0) : ?>
    <tr>
        <th scope="row" colspan="5">
            <h4 class="text-danger text-center">Data tidak ditemukan!</h4>
        </th>
    </tr>
<?php endif ?>