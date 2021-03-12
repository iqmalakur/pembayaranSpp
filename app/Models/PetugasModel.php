<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'petugas';
	protected $primaryKey           = 'username';
	protected $useAutoIncrement     = false;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['username', 'password', 'nama_petugas', 'level'];

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

	public function getPetugas($username)
	{
		return $this->find($username);
	}

	public function getLogin($data)
	{
		if ($petugas = $this->find($data['username'])) {
			if (password_verify($data['password'], $petugas->password)) {
				return true;
			}
		}

		return false;
	}

	public function getRole($username)
	{
		return $this->find($username)->level;
	}
}
