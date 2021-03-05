<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
	public function run()
	{
		$this->call("JurusanSeeder");
		$this->call("PetugasSeeder");
		$this->call("KelasSeeder");
		$this->call("SppSeeder");
		$this->call("SiswaSeeder");
		$this->call("PembayaranSeeder");
	}
}
