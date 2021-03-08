<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'nama_kelas' => 'XI RPL 1',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'XII RPL 1',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'X TKJ 1',
				'kompetensi_keahlian' => 2
			],
			[
				'nama_kelas' => 'XI TKJ 1',
				'kompetensi_keahlian' => 2
			],
			[
				'nama_kelas' => 'X MM 1',
				'kompetensi_keahlian' => 3
			],
			[
				'nama_kelas' => 'XII MM 2',
				'kompetensi_keahlian' => 3
			],
			[
				'nama_kelas' => 'X SIJA 1',
				'kompetensi_keahlian' => 4
			],
			[
				'nama_kelas' => 'XI SIJA 1',
				'kompetensi_keahlian' => 4
			],
			[
				'nama_kelas' => 'X ANI 1',
				'kompetensi_keahlian' => 5
			],
			[
				'nama_kelas' => 'XI ANI 1',
				'kompetensi_keahlian' => 5
			],
		];

		// Insert to Database
		$this->db->table("kelas")->insertBatch($data);
	}
}
