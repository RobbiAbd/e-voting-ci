<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabellevel extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * level
		 *
		 * Tabel untuk level
		 */
		$fields = [
			'id_level'      => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'level'         => ['type' => 'varchar', 'constraint' => 100],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_level', TRUE);

		$this->forge->createTable('level');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('level');

		$this->db->enableForeignKeyChecks();
	}
}
