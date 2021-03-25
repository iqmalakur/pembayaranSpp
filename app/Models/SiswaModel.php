<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'siswa';
	protected $primaryKey           = 'nisn';
	protected $useAutoIncrement     = false;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'nisn', 'nis', 'nama',
		'id_kelas', 'alamat', 'no_telp',
		'id_spp'
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

	public function get($nisn = false)
	{
		$builder = $this->builder("siswa");

		// Cek apakah parameter $nisn tidak kosong
		if ($nisn) {
			return $builder
				->select('siswa.*, kelas.nama_kelas, jurusan.nama_jurusan, spp.angkatan, spp.nominal')
				->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
				->join('spp', 'siswa.id_spp=spp.id_spp')
				->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
				->where('nisn', $nisn)
				->get()->getRowObject();
		}

		return $builder
			->select('siswa.nisn, siswa.nama, kelas.nama_kelas, spp.angkatan')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('spp', 'siswa.id_spp=spp.id_spp')
			->orderBy('siswa.nama', "ASC")
			->get()->getResultObject();
	}

	// Fungsi untuk cek login
	public function getLogin($data)
	{
		// Cek username dan password
		if ($siswa = $this->find($data['username'])) {
			if ($data['password'] == $siswa->nis) {
				return true;
			}
		}
		return false;
	}

	// Validasi ubah data (menghindari NIS ganda)
	public function cekNis($nis)
	{
		// Cek apakah NIS telah terdaftar
		return $this->builder('siswa')->where('nis', $nis)->countAllResults();
	}

	// Fungsi cari Siswa untuk pembayaran
	public function searchAjax($keyword)
	{
		return $this->builder('siswa')
			->select('nisn, nama, nama_kelas, angkatan')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('spp', 'siswa.id_spp=spp.id_spp')
			->like('nisn', $keyword)
			->orLike('angkatan', $keyword)
			->orLike('nama', $keyword)
			->orLike('nama_kelas', $keyword)
			->orderBy('siswa.nama')
			->get()->getResultObject();
	}

	public function getCount()
	{
		return $this->builder("siswa")->select("COUNT(*) AS count")->get()->getRowObject()->count;
	}

	public function cari($keyword)
	{
		return $this->builder('siswa')
			->select('siswa.nisn, siswa.nama, kelas.nama_kelas, spp.angkatan')
			->join('kelas', 'siswa.id_kelas=kelas.id_kelas')
			->join('spp', 'siswa.id_spp=spp.id_spp')
			->like('nisn', $keyword)
			->orLike('angkatan', $keyword)
			->orLike('nama', $keyword)
			->orLike('nama_kelas', $keyword)
			->orderBy('nama')
			->get()->getResultObject();
	}
}
