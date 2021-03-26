<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'pembayaran';
	protected $primaryKey           = 'id_pembayaran';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'petugas', 'nisn', 'tgl_bayar',
		'bulan_dibayar', 'tahun_dibayar',
		'id_spp', 'jumlah_bayar'
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function get($id)
	{
		return $this
			->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas, jurusan.nama_jurusan')
			->join('petugas', 'pembayaran.petugas=petugas.username')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->find($id);
	}

	// Ambil data pembayaran Siswa
	public function getPembayaran($nisn)
	{
		return $this
			->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas')
			->where('pembayaran.nisn', $nisn)
			->join('petugas', 'pembayaran.petugas=petugas.username')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->orderBy('tgl_bayar', 'DESC')
			->findAll();
	}

	// Cek apakah spp telah dibayar (menghindari data ganda)
	public function bulanSpp($nisn, $bulan, $tahun)
	{
		return $this
			->select('id_pembayaran')
			->where(['nisn' => $nisn, 'bulan_dibayar' => $bulan, 'tahun_dibayar' => $tahun])
			->findAll();
	}

	public function laporan($val)
	{
		return $this
			->select('pembayaran.*, siswa.nis, siswa.nama, kelas.nama_kelas, jurusan.nama_jurusan')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->where('pembayaran.tahun_dibayar', $val)
			->orderBy('tgl_bayar', 'DESC')
			->findAll();
	}

	// Menjumlahkan pembayaran per tahun
	public function getSum($val)
	{
		return $this
			->selectSum('jumlah_bayar', 'total')
			->where('tahun_dibayar', $val)
			->first()->total;
	}

	// Data untuk diagram (Dashboard)
	public function getReport()
	{
		$pembayaran = $this
			->select("tahun_dibayar AS tahun, SUM(jumlah_bayar) AS jumlah")
			->groupBy('tahun_dibayar')
			->orderBy('tahun_dibayar', 'DESC')
			->findAll();
		$laporan = [];

		foreach ($pembayaran as $index => $item) {
			if ($index < 5) {
				$laporan[] = $item;
			}
		}

		return array_reverse($laporan);
	}

	public function getTahun()
	{
		return $this->select('tahun_dibayar')->groupBy('tahun_dibayar')->findAll();
	}

	// Ubah petugas yang bersangkutan dengan data pembayaran menjadi admin
	// Jika petugas yang bersangkutan dihapus
	public function ubahPetugas($username)
	{
		$petugas = $this
			->select('id_pembayaran')
			->where('petugas', $username)
			->findAll();

		foreach ($petugas as $item) {
			$this->update($item->id_pembayaran, ['petugas' => 'admin']);
		}
	}

	// Data Pembayaran berdasarkan jurusan
	public function pembayaranJurusan()
	{
		return $this
			->select('jurusan.nama_jurusan AS nama, SUM(jumlah_bayar) AS jumlah')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->groupBy('jurusan.nama_jurusan')
			->findAll();
	}
}
