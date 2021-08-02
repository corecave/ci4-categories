<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique' => TRUE,
			),
			'parent_id' => array(
				'type' => 'INT',
				'constraint' => '100',
				'unsigned' => TRUE,
				'null' => TRUE
			),
		]);

		$this->forge->addKey('id', true);

		$this->forge->addForeignKey('parent_id', 'categories', 'id', 'CASCADE', 'CASCADE');

		$this->forge->createTable('categories');
	}

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
