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
				'password' => password_hash('123', PASSWORD_DEFAULT),
				'nama_petugas' => 'Admin',
				'level' => 'admin',
			],
			[
				'username' => 'setya123',
				'password' => password_hash('123', PASSWORD_DEFAULT),
				'nama_petugas' => 'Setya',
				'level' => 'petugas',
			],
			[
				'username' => 'ekasantoso',
				'password' => password_hash('123', PASSWORD_DEFAULT),
				'nama_petugas' => 'Eka Santoso',
				'level' => 'petugas',
			],
			[
				'username' => 'farah123',
				'password' => password_hash('123', PASSWORD_DEFAULT),
				'nama_petugas' => 'Farah Hastuti',
				'level' => 'petugas',
			],
			[
				'username' => 'hildafitri',
				'password' => password_hash('123', PASSWORD_DEFAULT),
				'nama_petugas' => 'Hilda Fitriani',
				'level' => 'petugas',
			],
		];

		// Insert to Database
		$this->db->table("petugas")->insertBatch($data);
	}
}
