<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jurusan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_jurusan' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'nama_jurusan' => [
				'type' => 'VARCHAR',
				'constraint' => 50,
			],
			'alias' => [
				'type' => 'VARCHAR',
				'constraint' => 5,
			],
		]);
		$this->forge->addKey('id_jurusan', true);
		$this->forge->createTable('jurusan');
	}

	public function down()
	{
		$this->forge->dropTable('jurusan');
	}
}
