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
				'nama_jurusan' => 'Sistem Informatika Jaringan dan Aplikasi',
				'alias' => 'SIJA'
			],
			[
				'nama_jurusan' => 'Animasi',
				'alias' => 'ANI'
			],
		];

		// Insert to Database
		$this->db->table("jurusan")->insertBatch($data);
	}
}
