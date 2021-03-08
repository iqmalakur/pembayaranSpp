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
				'id_petugas' => 3,
				'nisn' => '0025111328',
				'tgl_bayar' => '2019-03-21',
				'bulan_dibayar' => 'Maret',
				'tahun_dibayar' => '2018/2019',
				'id_spp' => 3,
				'jumlah_bayar' => 140000,
			],
			[
				'id_petugas' => 1,
				'nisn' => '0052871453',
				'tgl_bayar' => '2019-08-16',
				'bulan_dibayar' => 'Agustus',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 4,
				'jumlah_bayar' => 120000,
			],
			[
				'id_petugas' => 3,
				'nisn' => '0031243215',
				'tgl_bayar' => '2020-01-05',
				'bulan_dibayar' => 'Januari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 1,
				'jumlah_bayar' => 110000,
			],
			[
				'id_petugas' => 5,
				'nisn' => '0023214211',
				'tgl_bayar' => '2020-01-20',
				'bulan_dibayar' => 'Januari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 3,
				'jumlah_bayar' => 140000,
			],
			[
				'id_petugas' => 4,
				'nisn' => '0051232245',
				'tgl_bayar' => '2020-02-12',
				'bulan_dibayar' => 'Februari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 5,
				'jumlah_bayar' => 150000,
			],
		];

		// Insert to Database
		$this->db->table("pembayaran")->insertBatch($data);
	}
}
