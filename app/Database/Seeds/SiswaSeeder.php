<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'nisn' => '0024837201',
				'nis' => '18193284',
				'nama' => 'Ade Gunawan',
				'id_kelas' => 6,
				'alamat' => 'Padalarang',
				'no_telp' => '088432354322',
				'id_spp' => 2,
			],
			[
				'nisn' => '0024837202',
				'nis' => '19203284',
				'nama' => 'Ali',
				'id_kelas' => 3,
				'alamat' => 'Padalarang',
				'no_telp' => '088432354522',
				'id_spp' => 3,
			],
			[
				'nisn' => '0024837203',
				'nis' => '19203244',
				'nama' => 'Putri',
				'id_kelas' => 3,
				'alamat' => 'Padalarang',
				'no_telp' => '088436354322',
				'id_spp' => 3,
			],
			[
				'nisn' => '0024837204',
				'nis' => '18193284',
				'nama' => 'Edi Gunandi',
				'id_kelas' => 2,
				'alamat' => 'Padalarang',
				'no_telp' => '088432354322',
				'id_spp' => 4,
			],
			[
				'nisn' => '0024837205',
				'nis' => '20213584',
				'nama' => 'Alya',
				'id_kelas' => 1,
				'alamat' => 'Padalarang',
				'no_telp' => '088432354324',
				'id_spp' => 4,
			],
		];

		// Insert to Database
		$this->db->table("siswa")->insertBatch($data);
	}
}
