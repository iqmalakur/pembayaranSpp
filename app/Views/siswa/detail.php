<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Detail Data Siswa</h1>
<ul class="list-group">
    <li class="list-group-item">NISN : <?= $siswa->nisn; ?></li>
    <li class="list-group-item">NIS : <?= $siswa->nis; ?></li>
    <li class="list-group-item">Nama : <?= $siswa->nama; ?></li>
    <li class="list-group-item">Kelas : <?= $siswa->nama_kelas; ?></li>
    <li class="list-group-item">Kompetensi Keahlian : <?= $siswa->nama_jurusan; ?></li>
    <li class="list-group-item">Alamat : <?= $siswa->alamat; ?></li>
    <li class="list-group-item">No. Telepon : <?= $siswa->no_telp; ?></li>
    <li class="list-group-item">SPP : <?= $siswa->tahun . " | Rp " . number_format($siswa->nominal, 2, ',', '.'); ?></li>
</ul>
<a href="/siswa/edit/<?= $siswa->nisn; ?>" class="btn btn-primary">Ubah</a>
<form action="/siswa/delete/<?= $siswa->nisn; ?>" method="POST" class="d-inline">
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="DELETE">
    <span id="delete" class="btn btn-danger" data-item="<?= $siswa->nama; ?>">Hapus</span>
</form>
<a href="/siswa" class="btn btn-warning">Kembali</a>
<?= $this->endSection(); ?>