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

	public function get($id = false)
	{
		$builder = $this->builder("pembayaran");

		if ($id) {
			return $builder->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas, jurusan.nama_jurusan')->where('id_pembayaran', $id)->join('petugas', 'pembayaran.petugas=petugas.username')->join('siswa', 'pembayaran.nisn=siswa.nisn')->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')->get()->getRowObject();
		}

		return $builder->select('siswa.nisn, siswa.nama, kelas.nama_kelas, pembayaran.id_pembayaran, pembayaran.tgl_bayar, pembayaran.tahun_dibayar, pembayaran.bulan_dibayar, petugas.nama_petugas')->join('petugas', 'pembayaran.petugas=petugas.username')->join('siswa', 'pembayaran.nisn=siswa.nisn')->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->orderBy('pembayaran.tgl_bayar', 'DESC')->get()->getResultObject();
	}

	public function getPembayaran($nisn)
	{
		return $this->builder("pembayaran")->select('pembayaran.*, petugas.nama_petugas, siswa.nis, siswa.nama, kelas.nama_kelas')->where('pembayaran.nisn', $nisn)->join('petugas', 'pembayaran.petugas=petugas.username')->join('siswa', 'pembayaran.nisn=siswa.nisn')->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->orderBy('tgl_bayar', 'DESC')->get()->getResultObject();
	}

	public function bulanSpp($nisn, $bulan, $tahun)
	{
		return $this->builder('pembayaran')->select('id_pembayaran')->getWhere(['nisn' => $nisn, 'bulan_dibayar' => $bulan, 'tahun_dibayar' => $tahun])->getRowObject();
	}
}
