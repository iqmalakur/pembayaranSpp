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
	protected $allowedFields        = ['tahun', 'nominal'];

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

	public function cek($tahun)
	{
		return $this->builder("spp")->where('tahun', $tahun)->countAllResults();
	}

	public function cari($keyword)
	{
		return $this->builder('spp')->like('angkatan', $keyword)->orLike('nominal', $keyword)->orderBy('angkatan')->get()->getResultObject();
	}
}
