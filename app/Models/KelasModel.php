<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kelas';
	protected $primaryKey           = 'id_kelas';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_kelas', 'kompetensi_keahlian'];

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

	// Query Builder
	protected $kelasBuilder				= '';

	public function __construct()
	{
		$this->kelasBuilder = $this->builder("kelas");
		$this->builder();
	}

	public function get($id = false)
	{
		if ($id) {
			return $this->kelasBuilder->where('id_kelas', $id)->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')->get()->getRowObject();
		}
		return $this->kelasBuilder->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')->get()->getResultObject();
	}

	public function cek($kelas)
	{
		if ($this->kelasBuilder->where("nama_kelas", $kelas)->countAllResults() >= 1) {
			return true;
		}
		return false;
	}
}
