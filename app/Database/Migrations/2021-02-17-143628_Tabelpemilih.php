<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelpemilih extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * pemilih
		 *
		 * Tabel untuk pemilih
		 */
		$fields = [
			'id_pemilih'  => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'token_key'   => ['type' => 'varchar', 'constraint' => 50],
			'id_kandidat' => ['type' => 'int', 'constraint' => 11, 'null' => true],
			'created_at'  => ['type' => 'datetime'],
			'updated_at'  => ['type' => 'datetime'],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_pemilih', TRUE);
		$this->forge->addKey(['token_key', 'id_kandidat']);


		$this->forge->createTable('pemilih');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('pemilih');

		$this->db->enableForeignKeyChecks();
	}
}
