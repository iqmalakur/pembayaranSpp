<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spp extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_spp' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'kompetensi_keahlian' => [
				'type' => 'INT',
			],
			'nominal' => [
				'type' => 'INT',
			],
		]);
		$this->forge->addKey('id_spp', true);
		$this->forge->createTable('spp');
	}

	public function down()
	{
		$this->forge->dropTable('spp');
	}
}
