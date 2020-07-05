<?php 
/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LevelModel;
use Config\Services;

class Users extends BaseController
{
	public function index()
	{
		$data['title'] = 'Users';

		return view('admin/users/users', $data);
	}

	public function add()
	{
		helper(['form']);
		$userModel = new UserModel();
		$levelModel = new LevelModel();

		$data['title'] = 'Tambah User';
		$data['level'] = $levelModel->findAll();

		if ($this->request->getMethod() == 'post') {

			$rules = [
		    	'nama' 		=> 'required|alpha_space|min_length[2]',
		    	'email'		=> 'required|valid_email|is_unique[users.email]',
		    	'password'	=> 'required|min_length[3]',
		    	'level'		=> 'required|numeric'
    		];

    		if ($this->validate($rules)) {
    			$params = [
    				'nama' 		=> htmlspecialchars($this->request->getPost('nama')),
			    	'email'		=> htmlspecialchars($this->request->getPost('email')),
			    	'password'	=> htmlspecialchars(password_hash($this->request->getPost('nama'), PASSWORD_DEFAULT)),
			    	'id_level'	=> htmlspecialchars($this->request->getPost('level'))
    			];

    			$insert = $userModel->insert($params);

    			if ($insert) {
    				session()->setFlashdata('success', 'Berhasil menambah data');
    				return redirect()->route('admin/users');
    			} else {
    				session()->setFlashdata('danger', 'Gagal menambah data');
    				return redirect()->route('admin/users/add')->withInput();
    			}
    			
    		} else {
    			$data['validation'] = $this->validator;
    		}
		}
		
		return view('admin/users/tambah_user', $data);
	}

	public function delete()
	{
		$userModel = new UserModel();

		$id = htmlspecialchars($this->request->getPost('id'));
		$delete = $userModel->delete($userModel->escapeString($id));
		
		if ($delete) {
			session()->setFlashdata('success', 'Berhasil menghapus data');
			return redirect()->route('admin/users');
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/users');
		}
	}

	public function edit()
	{
		helper(['form','url']);
		$userModel = new UserModel();
		$levelModel = new LevelModel();

		$id = htmlspecialchars($this->request->uri->getSegment(4));

		if ($this->request->getMethod() == 'post') {
			$rules = [
		    	'nama' 		=> 'required|alpha_space|min_length[2]',
		    	'level'		=> 'required|numeric'
    		];

	    	if ($this->validate($rules)) {
	    		$params = [
	    				'nama' 		=> htmlspecialchars($this->request->getPost('nama')),
				    	'id_level'	=> htmlspecialchars($this->request->getPost('level'))
	    			];

	    			$update = $userModel->update($id , $params);

	    			if ($update) {
	    				session()->setFlashdata('success', 'Berhasil edit data');
	    				return redirect()->route('admin/users');
	    			} else {
	    				session()->setFlashdata('danger', 'Gagal edit data');
	    				return redirect()->route('admin/users/edit')->withInput();
	    			}
	    	}else {
	    		$data['validation'] = $this->validator;
	    	}
		}

		$data['title'] = 'Edit User';
		$data['user'] = $userModel->find($id);
		$data['level'] = $levelModel->findAll();
		
		return view('admin/users/edit_user', $data);
	}


	public function change_password()
	{
		helper(['form','url']);
		$userModel = new UserModel();

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'old_password'		=> ['label' => 'Password Lama', 'rules'	=> 	'required'],
				'new_password'		=> ['label' => 'Password Baru', 'rules' =>	'required|min_length[3]|matches[confirm_password]'],
				'confirm_password'	=> ['label' => 'Konfirmasi Password', 'rules' => 'required|min_length[3]|matches[new_password]']
			];

			if ($this->validate($rules)) {
				$old_password = htmlspecialchars($this->request->getPost('old_password'));
				$new_password = htmlspecialchars($this->request->getPost('new_password'));
				$confirm_password = htmlspecialchars($this->request->getPost('confirm_password'));

				//cek apakah new pass sama dengan old pass
				if ($new_password != $old_password) {
					// get data user by session email
					$user = $userModel->where('email', session()->get('email'))
									->first();

					//cek apakah password sama dengan yg ada di DB
					if (password_verify($old_password, $user['password'])) {
						$params = [
							'password' => password_hash($new_password, PASSWORD_DEFAULT)
						];

						$update = $userModel->update($user['id_user'], $params);

						if ($update) {
		    				session()->setFlashdata('success', 'Berhasil mengubah password');
		    				return redirect()->route('admin');
		    			} else {
		    				session()->setFlashdata('danger', 'Gagal mengubah password');
		    				return redirect()->route('admin/users/change_password');
		    			}

					}else {
						session()->setFlashdata('danger', 'Password salah');
	    				return redirect()->route('admin/user/change_password');
					}

				}else {
					session()->setFlashdata('danger', 'Password baru tidak boleh sama dengan password lama');
	    			return redirect()->route('admin/user/change_password');
				}

			}else {
				$data['validation'] = $this->validator;
			}
		}

		$data['title'] = 'Change Password';
		return view('admin/users/ganti_password', $data);
	}

	public function get_users_ajax()
	{
	  $request = Services::request();
	  $users = new UserModel($request);

	  if($request->getMethod(true) == 'POST'){
	    $lists = $users->get_datatables();
	        $data = [];
	        $no = $request->getPost("start");
	        foreach ($lists as $list) {
	        	//hilangkan syntak if ini bila ingin
	        	//menampilkan akun admin di datatable
	        	if ($list->email != 'admin@gmail.com') {
	                $no++;
	                $row = [];
	                $row[] = $no;
	                $row[] = $list->nama;
	                $row[] = $list->email;
	                $row[] = $list->id_level == 1 ? 'Administrator' : 'Petugas';
	                $row[] = $list->created_at;
	                $row[] = '<a class="btn btn-warning" href="'.base_url('admin/user/edit/'.$list->id_user).'">Edit</a> 
	                			<a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="'.$list->id_user.'">Hapus</a>';
	                $data[] = $row;
	        	}
	    }

	    $output = ["draw" => $request->getPost('draw'),
	                        "recordsTotal" => $users->count_all(),
	                        "recordsFiltered" => $users->count_filtered(),
	                        "data" => $data];

	    echo json_encode($output);
	  }
	}
}
