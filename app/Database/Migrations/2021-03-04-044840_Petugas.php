<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 25,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'nama_petugas' => [
				'type' => 'VARCHAR',
				'constraint' => 35,
			],
			'level' => [
				'type' => 'ENUM',
				'constraint' => array('admin', 'petugas'),
			],
		]);

		$this->forge->addKey('username', true);
		$this->forge->createTable('petugas');
	}

	public function down()
	{
		$this->forge->dropTable('petugas');
	}
}
