<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pembayaran' => [
				'type' => 'INT',
				'auto_increment' => true,
			],
			'id_petugas' => [
				'type' => 'INT',
			],
			'nisn' => [
				'type' => 'INT',
			],
			'tgl_bayar' => [
				'type' => 'DATE',
			],
			'bulan_dibayar' => [
				'type' => 'VARCHAR',
				'constraint' => 9,
			],
			'tahun_dibayar' => [
				'type' => 'VARCHAR',
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
		$this->forge->createTable('pembayaran');
	}

	public function down()
	{
		$this->forge->dropTable('pembayaran');
	}
}
