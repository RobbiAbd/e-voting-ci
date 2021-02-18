<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KandidatModel;
use App\Models\TokenModel;
use App\Models\PemilihModel;
use App\Models\UserModel;
use Config\Services;

class ResultVoting extends BaseController
{
	public function index()
	{
		$kandidatModel = new KandidatModel();
		$tokenModel = new TokenModel();
		$pemilihModel = new PemilihModel();
		$userModel = new UserModel();

		$data['title'] = 'Hasil Voting';
		$data['total_kandidat'] = $kandidatModel->select('COUNT(id_kandidat) as total_kandidat')->first();
		$data['total_token'] = $tokenModel->select('COUNT(id_token) as total_token')->first();
		$data['total_pemilih'] = $pemilihModel->select('COUNT(id_pemilih) as total_pemilih')->first();
		$data['total_petugas'] = $userModel->select('COUNT(id_user) as total_petugas')->first();

		$dateNow = date('Y-m-d');
		$data['get_aktivitas'] = $pemilihModel->select('token_key, created_at')
			->where('date(created_at)', $dateNow)
			->limit(5)
			->get()->getResultArray();

		$data['total_voting'] = $kandidatModel->get_kandidat_pemilih();

		return view('admin/hasil/lihat_hasil', $data);
	}

	public function get_result_ajax()
	{
		$request = Services::request();
		$security = Services::security();

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {
			$kandidatModel = new KandidatModel();
			$dataset = $kandidatModel->get_kandidat_pemilih();

			$data = [];
			$data['csrf'] = $security->getCSRFHash();
			if (!empty($dataset)) {
				foreach ($dataset as $key => $val) {
					$data['labels'][$key] = $val['nama'];
					$data['datas'][$key] = $val['total_voting'];
				}
			}

			echo json_encode($data);
		} else {
			echo json_encode([]);
		}
	}
}
