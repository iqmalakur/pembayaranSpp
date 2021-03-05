<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kelas' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'nama_kelas' => [
				'type' => 'VARCHAR',
				'constraint' => 10,
			],
			'kompetensi_keahlian' => [
				'type' => 'INT',
			],
		]);
		$this->forge->addKey('id_kelas', true);
		$this->forge->createTable('kelas');
	}

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
