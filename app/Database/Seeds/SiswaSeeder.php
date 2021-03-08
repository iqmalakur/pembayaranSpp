<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
	public function run()
	{
		// Menyiapkan Data
		$data = [
			[
				'nisn' => '0051232245',
				'nis' => '20215321',
				'nama' => 'Agung Halim',
				'id_kelas' => 9,
				'alamat' => 'Galanggang',
				'no_telp' => '081955543754',
				'id_spp' => 5,
			],
			[
				'nisn' => '0033435112',
				'nis' => '19202736',
				'nama' => 'Adi Wahyudi',
				'id_kelas' => 4,
				'alamat' => 'Cimahi',
				'no_telp' => '08785553273',
				'id_spp' => 2,
			],
			[
				'nisn' => '0032125123',
				'nis' => '18191535',
				'nama' => 'Devi Wulan',
				'id_kelas' => 2,
				'alamat' => 'Padalarang',
				'no_telp' => '085755525811',
				'id_spp' => 1,
			],
			[
				'nisn' => '0045213342',
				'nis' => '20214523',
				'nama' => 'Sinta',
				'id_kelas' => 8,
				'alamat' => 'Batujajar',
				'no_telp' => '083855525242',
				'id_spp' => 4,
			],
			[
				'nisn' => '0051313142',
				'nis' => '20215341',
				'nama' => 'Siska Sari',
				'id_kelas' => 9,
				'alamat' => 'Cimareme',
				'no_telp' => '085555559045',
				'id_spp' => 5,
			],
			[
				'nisn' => '0023214211',
				'nis' => '18193295',
				'nama' => 'Bambang',
				'id_kelas' => 6,
				'alamat' => 'Cikandang',
				'no_telp' => '081555577366',
				'id_spp' => 3,
			],
			[
				'nisn' => '0025111328',
				'nis' => '18193847',
				'nama' => 'Budi Suripto',
				'id_kelas' => 6,
				'alamat' => 'Cililin',
				'no_telp' => '08115554655',
				'id_spp' => 3,
			],
			[
				'nisn' => '0031243215',
				'nis' => '18191763',
				'nama' => 'Irwan Susanto',
				'id_kelas' => 2,
				'alamat' => 'Selacau',
				'no_telp' => '08135552093',
				'id_spp' => 1,
			],
			[
				'nisn' => '0045583284',
				'nis' => '19202553',
				'nama' => 'Wulandari',
				'id_kelas' => 4,
				'alamat' => 'Cangkorah',
				'no_telp' => '085755515832',
				'id_spp' => 2,
			],
			[
				'nisn' => '0052871453',
				'nis' => '20214532',
				'nama' => 'Lestari',
				'id_kelas' => 8,
				'alamat' => 'Cimahi',
				'no_telp' => '08385558034',
				'id_spp' => 4,
			],
		];

		// Insert to Database
		$this->db->table("siswa")->insertBatch($data);
	}
}
