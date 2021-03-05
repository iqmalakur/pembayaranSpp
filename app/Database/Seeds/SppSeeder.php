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
				'tahun_ajaran' => '2017/2018',
				'nominal' => 100000
			],
			[
				'tahun_ajaran' => '2018/2019',
				'nominal' => 110000
			],
			[
				'tahun_ajaran' => '2019/2020',
				'nominal' => 120000
			],
			[
				'tahun_ajaran' => '2020/2021',
				'nominal' => 130000
			],
			[
				'tahun_ajaran' => '2021/2022',
				'nominal' => 140000
			],
		];

		// Insert to Database
		$this->db->table("spp")->insertBatch($data);
	}
}
