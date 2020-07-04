<?php
/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
	public function index()
	{
		$data['title'] = 'Dashboard';

		return view('admin/index', $data);
	}
}
