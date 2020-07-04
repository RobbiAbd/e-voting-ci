<?php 
namespace App\Controllers;

class Tentang extends BaseController
{
	public function index()
	{
		$data['title'] = 'Tentang Kami';

		return view('tentang', $data);
	}
}
