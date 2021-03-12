<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		if ($this->session->login) {
			$this->session->setFlashdata('loginInfo', true);
			return redirect()->to(previous_url());
		}

		$data = [
			"title" => "Login",
			"controller" => explode("\\", get_class($this))[2],
			"role" => $this->role,
			"errors" => $this->session->get('errors'),
		];

		return view("auth/index", $data);
	}

	public function login()
	{
		$data = [
			'username'  => $this->request->getPost('username'),
			'password'  => $this->request->getPost('password')
		];

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if ($validation->run($data, 'login') == FALSE) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/login')->withInput();
		} else {
			$petugasModel = new \App\Models\PetugasModel();
			$role = false;

			if ($petugasModel->getLogin($data)) {
				$role = $petugasModel->getRole($data['username']);
			} else {
				$siswaModel = new \App\Models\SiswaModel();

				if ($siswaModel->getLogin($data)) {
					$role = "siswa";
				}
			}

			if ($role) {
				$this->session->setFlashdata('success', true);
				$user = $role == 'siswa' ? $siswaModel->getSiswa($data['username']) : $petugasModel->getPetugas($data['username']);

				$this->session->set([
					'login' => true,
					'user' => [
						'username' => $role == 'siswa' ? $user->nisn : $user->username,
						'password' => $role == 'siswa' ? $user->nis : $user->password,
						'role' => $role,
					],
				]);

				// Redirect ke Dashboard
				return redirect()->to('/');
			} else {
				$this->session->setFlashdata('errors', ['login-fail' => 'Username atau Password salah']);

				// Kembali ke halaman login dan mengirimkan input sebelumnya
				return redirect()->to('/login')->withInput();
			}
		}
	}

	public function logout()
	{
		$this->session->destroy();

		return redirect()->to('/login');
	}
}
