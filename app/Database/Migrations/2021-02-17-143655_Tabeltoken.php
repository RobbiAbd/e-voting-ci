<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabeltoken extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * token
		 *
		 * Tabel untuk token
		 */
		$fields = [
			'id_token'              => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'token_key'             => ['type' => 'varchar', 'constraint' => 50],
			'jumlah_pengguna_token' => ['type' => 'int', 'constraint' => 11],
			'expired_at'            => ['type' => 'datetime'],
			'created_at'            => ['type' => 'datetime'],
			'updated_at'            => ['type' => 'datetime'],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_token', TRUE);
		$this->forge->addKey('token_key');


		$this->forge->createTable('token');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('token');

		$this->db->enableForeignKeyChecks();
	}
}
