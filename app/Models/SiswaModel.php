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

		if ($nisn) {
			return $builder->select('siswa.*, kelas.nama_kelas, jurusan.nama_jurusan, spp.tahun, spp.nominal')->where('nisn', $nisn)->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->join('spp', 'siswa.id_spp=spp.id_spp')->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')->get()->getRowObject();
		}

		return $builder->select('siswa.nisn, siswa.nis, siswa.nama, kelas.nama_kelas')->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->orderBy('siswa.nama', "ASC")->get()->getResultObject();
	}

	public function getLogin($data)
	{
		if ($siswa = $this->find($data['username'])) {
			if ($data['password'] == $siswa->nis) {
				return true;
			}
		}
		return false;
	}

	public function cekNis($nis)
	{
		return $this->builder('siswa')->where('nis', $nis)->countAllResults();
	}

	public function searchAjax($keyword)
	{
		return $this->builder('siswa')->select('nisn, nis, nama, nama_kelas, nama_jurusan')->like('nisn', $keyword, 'after')->orLike('nis', $keyword, 'after')->orLike('nama', $keyword, 'after')->orLike('nama_kelas', $keyword)->join('kelas', 'siswa.id_kelas=kelas.id_kelas')->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')->get()->getResultObject();
	}

	public function getCount()
	{
		return $this->builder("siswa")->select("COUNT(*) AS count")->get()->getRowObject()->count;
	}
}
