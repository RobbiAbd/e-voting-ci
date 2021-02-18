<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TokenModel;
use Config\Services;

class Token extends BaseController
{
	public function index()
	{
		$data['title'] = 'Token';

		return view('admin/token/token', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Token';
		$data['token'] = $this->token_generate();
		$tokenModel = new TokenModel();

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'token_key' 			=> 'required|is_unique[token.token_key]',
				'jumlah' 				=> 'required|integer|min_length[1]',
				'expired_at'			=> 'required|integer'
			];

			if ($this->validate($rules)) {
				$currentTime = time();

				$currentTime = $currentTime + $tokenModel->escapeString(esc($this->request->getPost('expired_at')));

				$params = [
					'token_key'				=> $tokenModel->escapeString(esc($this->request->getPost('token_key'))),
					'jumlah_pengguna_token' => $tokenModel->escapeString(esc($this->request->getPost('jumlah'))),
					'expired_at'			=> date('Y-m-d H:i:s', $currentTime)
				];

				$insert = $tokenModel->insert($params);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data');
					return redirect()->route('admin/token');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data');
					return redirect()->route('admin/token/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/token/tambah_token', $data);
	}

	public function bulk_add()
	{
		$data['title'] = 'Bulk Token';
		$tokenModel = new TokenModel();

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'jumlah' 				=> 'required|integer|min_length[1]',
				'expired_at'			=> 'required|integer'
			];

			if ($this->validate($rules)) {
				$currentTime = time();

				$currentTime = $currentTime + $tokenModel->escapeString(esc($this->request->getPost('expired_at')));

				$jumlah = $tokenModel->escapeString(esc($this->request->getPost('jumlah')));

				$data_token = [];

				for ($i = 0; $i < $jumlah; $i++) {
					$index = $i + 1;

					$params = [
						'token_key'				=> $this->token_generate() . $index,
						'jumlah_pengguna_token' => 1,
						'expired_at'			=> date('Y-m-d H:i:s', $currentTime),
						'created_at'			=> date('Y-m-d H:i:s')
					];

					array_push($data_token, $params);
				}

				$insert = $tokenModel->insertBatch($data_token);

				if ($insert) {
					session()->setFlashdata('success', 'Berhasil menambah data');
					return redirect()->route('admin/token');
				} else {
					session()->setFlashdata('danger', 'Gagal menambah data');
					return redirect()->route('admin/token/add')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/token/tambah_bulk_token', $data);
	}

	public function delete()
	{
		$tokenModel = new TokenModel();

		$id = $tokenModel->escapeString(esc($this->request->getPost('id')));

		$delete = $tokenModel->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data');
			return redirect()->route('admin/token');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/token');
		}
	}

	public function delete_all()
	{
		$tokenModel = new TokenModel();

		$delete = $tokenModel->truncate();

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus semua data');
			return redirect()->route('admin/token');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus semua data');
			return redirect()->route('admin/token');
		}
	}

	private function token_generate()
	{
		$karakter = '!*ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstupwxyz';
		$string = '';
		for ($i = 0; $i < 5; $i++) {
			$pos = rand(0, strlen($karakter) - 1);
			$string .= $karakter[$pos];
		}
		return $string;
	}

	public function get_token_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$tokenModel = new TokenModel($request);
		$token_use = $tokenModel->users_token_count();

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {
			$lists = $tokenModel->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->token_key;
				$row[] = esc($list->jumlah_pengguna_token);
				foreach ($token_use as $token_val) {
					if ($token_val['token_key'] == $list->token_key) {
						$row[] = $token_val['total_pengguna_saat_ini'];
					}
				}
				$row[] = $list->expired_at;
				$row[] = $list->created_at;
				$row[] = '<a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_token . '">Hapus</a>';
				$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $tokenModel->count_all(),
				"recordsFiltered" => $tokenModel->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
