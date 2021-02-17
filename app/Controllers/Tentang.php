<?php 

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers;

class Tentang extends BaseController
{
	public function index()
	{
		$data['title'] = 'Tentang Kami';

		return view('tentang', $data);
	}
}
