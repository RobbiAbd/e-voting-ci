<?php 

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['title'] = 'Home';

		return view('home', $data);
	}
}
