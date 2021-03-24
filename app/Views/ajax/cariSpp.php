<?php foreach ($spp as $index => $item) : ?>
    <tr>
        <th scope="row"><?= $index + 1; ?></th>
        <td><?= preg_replace("/" . preg_replace("/\//", "\/", $keyword) . "/i", "<mark>$keyword</mark>", $item->angkatan); ?></td>
        <td><?= "Rp. " . number_format($item->nominal, 2, ',', '.'); ?></td>
        <td>
            <a href="/spp/edit/<?= $item->id_spp; ?>" class="btn btn-primary" title="Ubah"><i class="bi bi-pencil"></i></a>
            <form action="/spp/delete/<?= $item->id_spp; ?>" method="POST" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <span class="delete btn btn-danger" data-item="Spp untuk Angkatan <?= $item->angkatan; ?>" title="Hapus"><i class="bi bi-trash"></i></span>
            </form>
        </td>
    </tr>
<?php endforeach ?>
<?php if (count($spp) <= 0) : ?>
    <tr>
        <th scope="row" colspan="4">
            <h4 class="text-danger text-center">Data tidak ditemukan!</h4>
        </th>
    </tr>
<?php endif ?>