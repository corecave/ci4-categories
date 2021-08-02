<?php

namespace App\Controllers;

use App\Models\Category as CategoryModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\HTTP\RequestInterface;

class Category extends BaseController
{
	public function index()
	{
		// $model = model('Category');

		// foreach (range(1, 50) as $key) {
		// 	$model->insert([
		// 		'title'      => Seeder::faker()->word,
		// 	]);
		// }
		

		return view('category');
	}

	public function parents()
	{
		if ($this->request->getMethod() !== 'post') {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forMethodNotFound('post');
		}

		$category = model('Category');
		$data = $category->where('parent_id', null)->findAll();

		return $this->response->setJSON($data);
	}

	public function childs(string $parent_id)
	{
		if ($this->request->getMethod() !== 'post') {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forMethodNotFound('post');
		}
		
		$data = model('Category')->childs($parent_id);

		return $this->response->setJSON($data);
	}
}
