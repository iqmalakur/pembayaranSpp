<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurusanSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'nama_jurusan' => 'Rekayasa Perangkat Lunak',
				'alias' => 'RPL'
			],
			[
				'nama_jurusan' => 'Teknik Komputer dan Jaringan',
				'alias' => 'TKJ'
			],
			[
				'nama_jurusan' => 'Multimedia',
				'alias' => 'MM'
			],
			[
				'nama_jurusan' => 'Akuntansi',
				'alias' => 'AK'
			],
			[
				'nama_jurusan' => 'Teknik Mesin',
				'alias' => 'TM'
			],
		];

		// Insert to Database
		$this->db->table("jurusan")->insertBatch($data);
	}
}
