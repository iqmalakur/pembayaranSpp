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

	public function get($id = false)
	{
		// Cek apakah parameter $id tidak kosong
		if ($id) {
			return $this
				->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
				->find($id);
		}

		return $this
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->orderBy("nama_kelas")
			->paginate($this->paginationLength, 'kelas');
	}

	// Validasi ubah data (menghindari nama kelas ganda)
	public function cek($kelas)
	{
		// Cek apakah nama kelas telah terdaftar
		return $this->where("nama_kelas", $kelas)->findAll();
	}

	public function cari($keyword)
	{
		return $this
			->join('jurusan', 'kelas.kompetensi_keahlian=jurusan.id_jurusan')
			->like('nama_kelas', $keyword)
			->orLike('nama_jurusan', $keyword)
			->orderBy('nama_kelas')
			->paginate($this->paginationLength, 'kelas');
	}

	// Cek apakah data memiliki relasi siswa
	public function cekHapus($id)
	{
		return $this->builder('siswa')->where('id_kelas', $id)->get()->getResultObject();
	}
}
