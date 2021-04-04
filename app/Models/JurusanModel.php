<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'jurusan';
	protected $primaryKey           = 'id_jurusan';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_jurusan', 'alias'];

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

	// Validasi ubah data (menghindari nama jurusan ganda)
	public function cek($jurusan)
	{
		// Cek apakah nama jurusan telah terdaftar
		return $this->where("nama_jurusan", $jurusan)->countAllResults();
	}

	public function cari($keyword)
	{
		return $this
			->like('nama_jurusan', $keyword)
			->orLike('alias', $keyword)
			->orderBy('nama_jurusan')
			->paginate($this->paginationLength, 'jurusan');
	}

	// Cek apakah data memiliki relasi kelas
	public function cekHapus($id)
	{
		return $this->builder('kelas')->where('kompetensi_keahlian', $id)->get()->getResultObject();
	}
}
