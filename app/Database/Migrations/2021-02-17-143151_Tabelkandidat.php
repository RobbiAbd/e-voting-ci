<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelkandidat extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * Kandidat
		 *
		 * Tabel untuk kandidat
		 */
		$fields = [
			'id_kandidat'  => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'nama'         => ['type' => 'varchar', 'constraint' => 150],
			'visi'         => ['type' => 'text'],
			'misi'         => ['type' => 'text'],
			'avatar'       => ['type' => 'datetime'],
			'created_at'   => ['type' => 'datetime'],
			'updated_at'   => ['type' => 'datetime'],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_kandidat', TRUE);

		$this->forge->createTable('kandidat');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('kandidat');

		$this->db->enableForeignKeyChecks();
	}
}
