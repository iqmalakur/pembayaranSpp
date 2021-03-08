<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SppSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'kompetensi_keahlian' => 1,
				'nominal' => 110000
			],
			[
				'kompetensi_keahlian' => 2,
				'nominal' => 130000
			],
			[
				'kompetensi_keahlian' => 3,
				'nominal' => 140000
			],
			[
				'kompetensi_keahlian' => 4,
				'nominal' => 120000
			],
			[
				'kompetensi_keahlian' => 5,
				'nominal' => 150000
			],
		];

		// Insert to Database
		$this->db->table("spp")->insertBatch($data);
	}
}
