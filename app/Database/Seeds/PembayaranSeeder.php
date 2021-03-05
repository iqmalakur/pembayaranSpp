<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'id_petugas' => 1,
				'nisn' => '0024837202',
				'tgl_bayar' => '2020-01-01',
				'bulan_dibayar' => 'Januari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 3,
				'jumlah_bayar' => 120000,
			],
			[
				'id_petugas' => 3,
				'nisn' => '0024837201',
				'tgl_bayar' => '2020-02-01',
				'bulan_dibayar' => 'Februari',
				'tahun_dibayar' => '2018/2019',
				'id_spp' => 2,
				'jumlah_bayar' => 110000,
			],
		];

		// Insert to Database
		$this->db->table("pembayaran")->insertBatch($data);
	}
}
