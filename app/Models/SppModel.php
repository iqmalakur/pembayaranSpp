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
	protected $allowedFields        = ['tahun_ajaran', 'nominal'];

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

	// Validasi ubah data (menghindari tahun ajaran ganda)
	public function cek($tahun)
	{
		// Cek apakah tahun ajaran telah terdaftar
		return $this->where('tahun_ajaran', $tahun)->findAll();
	}

	public function cari($keyword)
	{
		return $this
			->like('tahun_ajaran', $keyword)
			->orLike('nominal', $keyword)
			->orderBy('tahun_ajaran')
			->paginate($this->paginationLength, 'spp');
	}

	// Cek apakah data memiliki relasi siswa atau pembayaran
	public function cekHapus($id)
	{
		if ($this->builder('siswa')->where('id_spp', $id)->get()->getResultObject()) {
			if ($this->builder('pembayaran')->where('id_spp', $id)->get()->getResultObject()) {
				return true;
			}
		}
		return false;
	}
}
