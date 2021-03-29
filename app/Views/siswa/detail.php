<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1 class="text-center">Detail Data Siswa</h1>
<div class="card my-4">
    <div class="card-header">
        <h5 class="card-title"><?= $siswa->nama; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= "$siswa->nisn / $siswa->nis"; ?></h6>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Kelas : <?= $siswa->nama_kelas; ?></li>
        <li class="list-group-item">Kompetensi Keahlian : <?= $siswa->nama_jurusan; ?></li>
        <li class="list-group-item">Alamat : <?= $siswa->alamat; ?></li>
        <li class="list-group-item">No. Telepon : <?= $siswa->no_telp; ?></li>
        <li class="list-group-item">Spp : <?= $siswa->tahun_ajaran . " | Rp " . number_format($siswa->nominal, 2, ',', '.'); ?></li>
    </ul>
</div>
<a href="/siswa/edit/<?= $siswa->nisn; ?>" class="btn btn-primary ms-2"><i class="bi bi-pencil"></i> Ubah</a>
<form action="/siswa/delete/<?= $siswa->nisn; ?>" method="POST" class="d-inline ms-2">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="DELETE">
    <span class="delete btn btn-danger" data-item="<?= $siswa->nama; ?>"><i class="bi bi-trash"></i> Hapus</span>
</form>
<a href="/siswa" class="btn btn-warning ms-2"><i class="bi bi-arrow-return-left"></i> Kembali</a>
<?= $this->endSection(); ?>