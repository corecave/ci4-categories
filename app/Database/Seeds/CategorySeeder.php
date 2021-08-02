<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
	public function run()
	{
		$model = model('Category');

		$this->db->table('categories')->truncate();

		$this->db->disableForeignKeyChecks();
		foreach (range(1,50) as $key) {
			$model->insert([
				'title'      => implode(' ', static::faker()->unique->words(2)),
				'parent_id'      => mt_rand(1, 10)
			]);
		}
		$this->db->enableForeignKeyChecks();

		foreach (range(1,10) as $id) {
			$this->db->query('UPDATE `'. env('database.default.DBPrefix', '') .'categories` SET `parent_id`=NULL WHERE `id`=:id:', compact('id'));
		}

		foreach (range(20, 50) as $id) {
			$this->db->query('UPDATE `' . env('database.default.DBPrefix', '') . 'categories` SET `parent_id`= ROUND((RAND() * (50-10))+10) WHERE `id`=:id:', compact('id'));
		}
	}
}
