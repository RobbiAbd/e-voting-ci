<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		$userModel = new UserModel();

		$data['title'] = 'Login';

		if ($this->request->getMethod() == 'post') {
			// rules validation
			$rules = [
				'email'		=> 'required|valid_email',
				'password' 	=> 'required|min_length[3]'
			];

			// form validation
			if ($this->validate($rules)) {
				$email 		= $userModel->escapeString(esc($this->request->getPost('email')));
				$password 	= $userModel->escapeString(esc($this->request->getPost('password')));

				// ambil data user dari DB
				$user = $userModel->where('email', $email)
					->first();

				if ($user) {
					if (password_verify($password, $user['password'])) {

						$userSession = [
							'nama'			=> $user['nama'],
							'email'			=> $user['email'],
							'id_level'		=> $user['id_level'],
						];

						session()->set($userSession);

						// cek level
						if ($user['id_level'] == 1) {
							session()->setFlashdata('success', 'Berhasil login');

							return redirect()->route('admin');
						} elseif ($user['id_level'] == 2) {
							session()->setFlashdata('success', 'Berhasil login');

							return redirect()->route('admin');
						} else {
							return redirect()->route('logout');
						}
					} else {
						// password salah
						session()->setFlashdata('danger', 'Email atau Password salah');

						return redirect('login')->withInput();
					}
				} else {
					// user tidak terdaftar
					session()->setFlashdata('danger', 'Maaf email dan password yang kamu masukan tidak terdaftar');

					return redirect('login')->withInput();
				}
			} else {
				// inputan salah
				$data['validation'] = $this->validator;
			}
		}

		return view('auth/index', $data);
	}

	public function logout()
	{
		session()->destroy();

		return redirect()->route('login');
	}
}
