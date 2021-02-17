<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelusers extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * users
		 *
		 * Tabel untuk users
		 */
		$fields = [
			'id_user'     => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'nama'        => ['type' => 'varchar', 'constraint' => 100],
			'email'       => ['type' => 'varchar', 'constraint' => 100, 'unique' => true],
			'password'    => ['type' => 'varchar', 'constraint' => 225],
			'id_level'    => ['type' => 'int', 'constraint' => 11],
			'created_at'  => ['type' => 'datetime'],
			'updated_at'  => ['type' => 'datetime'],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_user', TRUE);
		$this->forge->addKey('id_level');


		$this->forge->createTable('users');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('users');

		$this->db->enableForeignKeyChecks();
	}
}
