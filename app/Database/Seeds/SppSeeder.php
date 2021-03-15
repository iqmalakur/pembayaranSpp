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
				'tahun' => "2017/2018",
				'nominal' => 110000
			],
			[
				'tahun' => "2018/2019",
				'nominal' => 130000
			],
			[
				'tahun' => "2019/2020",
				'nominal' => 140000
			],
			[
				'tahun' => "2020/2021",
				'nominal' => 120000
			],
			[
				'tahun' => "2021/2022",
				'nominal' => 150000
			],
		];

		// Insert to Database
		$this->db->table("spp")->insertBatch($data);
	}
}
