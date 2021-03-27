<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id_pembayaran' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'petugas' => [
				'type' => 'VARCHAR',
				'constraint' => 25,
			],
			'nisn' => [
				'type' => 'CHAR',
				'constraint' => 10,
			],
			'tgl_bayar' => [
				'type' => 'DATE',
			],
			'bulan_dibayar' => [
				'type' => 'INT',
			],
			'tahun_dibayar' => [
				'type' => 'CHAR',
				'constraint' => 9,
			],
			'id_spp' => [
				'type' => 'INT',
			],
			'jumlah_bayar' => [
				'type' => 'INT',
			],
		]);

		$this->forge->addKey('id_pembayaran', true);
		$this->forge->addForeignKey('petugas', 'petugas', 'username');
		$this->forge->addForeignKey('nisn', 'siswa', 'nisn');
		$this->forge->addForeignKey('id_spp', 'spp', 'id_spp');
		$this->forge->createTable('pembayaran');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran');
	}
}
