<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'nisn' => [
				'type' => 'CHAR',
				'constraint' => 10,
			],
			'nis' => [
				'type' => 'CHAR',
				'constraint' => 8,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 35,
			],
			'id_kelas' => [
				'type' => 'INT'
			],
			'alamat' => [
				'type' => 'TEXT'
			],
			'no_telp' => [
				'type' => 'VARCHAR',
				'constraint' => 13,
			],
			'id_spp' => [
				'type' => 'INT'
			],
		]);
		$this->forge->addKey('nisn', true);
		$this->forge->createTable('siswa');
	}

	public function down()
	{
		$this->forge->dropTable('siswa');
	}
}
