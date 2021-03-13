<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'spp';
	protected $primaryKey           = 'id_spp';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['kompetensi_keahlian', 'nominal'];

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
	protected $sppBuilder			= '';

	public function __construct()
	{
		$this->sppBuilder = $this->builder("spp");
		$this->builder();
	}

	public function get($id = false)
	{
		if ($id) {
			return $this->sppBuilder->where('id_spp', $id)->join('jurusan', 'spp.kompetensi_keahlian=jurusan.id_jurusan')->get()->getRowObject();
		}
		return $this->sppBuilder->join('jurusan', 'spp.kompetensi_keahlian=jurusan.id_jurusan')->get()->getResultObject();
	}

	public function cek($jurusan)
	{
		return $this->sppBuilder->join('jurusan', 'spp.kompetensi_keahlian=jurusan.id_jurusan')->where('id_jurusan', $jurusan)->get()->getRowObject();
	}
}
