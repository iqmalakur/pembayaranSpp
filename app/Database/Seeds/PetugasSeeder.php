<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PetugasSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'username' => 'admin',
				'password' => '123',
				'nama_petugas' => 'Admin',
				'level' => 'admin',
			],
			[
				'username' => 'ucup123',
				'password' => '123',
				'nama_petugas' => 'Ucup',
				'level' => 'petugas',
			],
			[
				'username' => 'dedi123',
				'password' => '123',
				'nama_petugas' => 'Dedi',
				'level' => 'petugas',
			],
			[
				'username' => 'indah123',
				'password' => '123',
				'nama_petugas' => 'Indah',
				'level' => 'petugas',
			],
			[
				'username' => 'gilang123',
				'password' => '123',
				'nama_petugas' => 'Gilang',
				'level' => 'petugas',
			],
		];

		// Insert to Database
		$this->db->table("petugas")->insertBatch($data);
	}
}
