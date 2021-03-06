<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PembayaranSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'petugas' => 'ekasantoso',
				'nisn' => '0025111328',
				'tgl_bayar' => '2019-03-21',
				'bulan_dibayar' => 'Maret',
				'tahun_dibayar' => '2018/2019',
				'id_spp' => 3,
				'jumlah_bayar' => 130000,
			],
			[
				'petugas' => 'admin',
				'nisn' => '0052871453',
				'tgl_bayar' => '2019-08-16',
				'bulan_dibayar' => 'Agustus',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 4,
				'jumlah_bayar' => 140000,
			],
			[
				'petugas' => 'ekasantoso',
				'nisn' => '0031243215',
				'tgl_bayar' => '2020-01-05',
				'bulan_dibayar' => 'Januari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 1,
				'jumlah_bayar' => 140000,
			],
			[
				'petugas' => 'hildafitri',
				'nisn' => '0023214211',
				'tgl_bayar' => '2020-01-20',
				'bulan_dibayar' => 'Januari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 3,
				'jumlah_bayar' => 140000,
			],
			[
				'petugas' => 'farah123',
				'nisn' => '0051232245',
				'tgl_bayar' => '2020-02-12',
				'bulan_dibayar' => 'Februari',
				'tahun_dibayar' => '2019/2020',
				'id_spp' => 5,
				'jumlah_bayar' => 140000,
			],
		];

		// Insert to Database
		$this->db->table("pembayaran")->insertBatch($data);
	}
}
