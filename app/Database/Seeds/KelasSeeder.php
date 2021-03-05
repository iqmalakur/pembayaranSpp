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
				'nama_kelas' => 'X RPL 1',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'X TKJ 1',
				'kompetensi_keahlian' => 2
			],
			[
				'nama_kelas' => 'XI MM 1',
				'kompetensi_keahlian' => 3
			],
			[
				'nama_kelas' => 'X RPL 2',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'XI RPL 1',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'XII TKJ 1',
				'kompetensi_keahlian' => 2
			],
			[
				'nama_kelas' => 'XII RPL 1',
				'kompetensi_keahlian' => 1
			],
			[
				'nama_kelas' => 'XII TKJ 2',
				'kompetensi_keahlian' => 2
			],
			[
				'nama_kelas' => 'XI MM 2',
				'kompetensi_keahlian' => 3
			],
			[
				'nama_kelas' => 'X MM 1',
				'kompetensi_keahlian' => 3
			],
		];

		// Insert to Database
		$this->db->table("kelas")->insertBatch($data);
	}
}
