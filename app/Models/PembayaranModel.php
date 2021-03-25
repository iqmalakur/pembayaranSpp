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
		return $this->builder("pembayaran")
			->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas, jurusan.nama_jurusan')
			->join('petugas', 'pembayaran.petugas=petugas.username')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->where('id_pembayaran', $id)
			->get()->getRowObject();
	}

	// Ambil data pembayaran Siswa
	public function getPembayaran($nisn)
	{
		return $this->builder("pembayaran")
			->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas')
			->where('pembayaran.nisn', $nisn)
			->join('petugas', 'pembayaran.petugas=petugas.username')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->orderBy('tgl_bayar', 'DESC')
			->get()->getResultObject();
	}

	// Cek apakah spp telah dibayar (menghindari data ganda)
	public function bulanSpp($nisn, $bulan, $tahun)
	{
		return $this->builder('pembayaran')
			->select('id_pembayaran')
			->getWhere(['nisn' => $nisn, 'bulan_dibayar' => $bulan, 'tahun_dibayar' => $tahun])
			->getRowObject();
	}

	public function laporan($val)
	{
		return $this->builder("pembayaran")
			->select('pembayaran.*, siswa.nis, siswa.nama, kelas.nama_kelas, jurusan.nama_jurusan')
			->join('siswa', 'pembayaran.nisn=siswa.nisn')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->where('pembayaran.tahun_dibayar', $val)
			->orderBy('tgl_bayar', 'DESC')
			->get()->getResultObject();
	}

	// Menjumlahkan pembayaran per tahun
	public function getSum($val)
	{
		return $this->builder("pembayaran")
			->select('SUM(pembayaran.jumlah_bayar) AS total')
			->where('pembayaran.tahun_dibayar', $val)
			->get()->getRowObject()->total;
	}

	// Total Transaksi Pembayaran
	public function getCount()
	{
		return $this->builder("pembayaran")
			->select('COUNT(*) AS count')
			->get()
			->getRowObject()->count;
	}

	// Data untuk diagram (Dashboard)
	public function getReport()
	{
		return $this->builder("pembayaran")
			->select("pembayaran.tahun_dibayar AS tahun, SUM(pembayaran.jumlah_bayar) AS jumlah")
			->groupBy('pembayaran.tahun_dibayar')
			->get()->getResultObject();
	}

	public function getTahun()
	{
		return $this->builder('pembayaran')->select('tahun_dibayar')->groupBy('tahun_dibayar')->get()->getResultObject();
	}

	// Ubah petugas yang bersangkutan dengan data pembayaran menjadi admin
	// Jika petugas yang bersangkutan dihapus
	public function ubahPetugas($username)
	{
		$petugas = $this->builder('pembayaran')
			->select('id_pembayaran')
			->where('petugas', $username)
			->get()->getResultObject();

		foreach ($petugas as $item) {
			$this->update($item->id_pembayaran, ['petugas' => 'admin']);
		}
	}
}
