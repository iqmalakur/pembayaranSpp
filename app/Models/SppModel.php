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
	protected $allowedFields        = ['angkatan', 'nominal'];

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

	// Validasi ubah data (menghindari tahun angkatan ganda)
	public function cek($tahun)
	{
		// Cek apakah tahun angkatan telah terdaftar
		return $this->where('angkatan', $tahun)->findAll();
	}

	public function cari($keyword)
	{
		return $this
			->like('angkatan', $keyword)
			->orLike('nominal', $keyword)
			->orderBy('angkatan')
			->findAll();
	}
}
