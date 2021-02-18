<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PemilihModel;
use Config\Services;

class Pemilih extends BaseController
{
	public function index()
	{
		$data['title'] = 'Pemilih';

		return view('admin/pemilih/pemilih', $data);
	}

	public function delete()
	{
		$pemilihModel = new PemilihModel();

		$id = $pemilihModel->escapeString(esc($this->request->getPost('id')));

		$delete = $pemilihModel->delete($pemilihModel->escapeString($id));

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data');
			return redirect()->route('admin/pemilih');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/pemilih');
		}
	}

	public function delete_all()
	{
		$pemilihModel = new PemilihModel();

		$delete = $pemilihModel->truncate();

		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data');
			return redirect()->route('admin/pemilih');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/pemilih');
		}
	}

	public function get_pemilih_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$pemilihModel = new PemilihModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {
			$lists = $pemilihModel->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = $list->token_key;
				$row[] = $list->created_at;
				$row[] = '<a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_pemilih . '">Hapus</a>';
				$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $pemilihModel->count_all(),
				"recordsFiltered" => $pemilihModel->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
