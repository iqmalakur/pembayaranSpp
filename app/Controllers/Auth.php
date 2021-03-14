<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
	public function index()
	{
		if ($this->session->login) {
			return redirect()->to(previous_url());
		}

		$this->data["title"] = "Login";
		$this->data["errors"] = $this->session->get('errors');

		return view("auth/index", $this->data);
	}

	public function login()
	{
		$data = $this->request->getPost(['username', 'password']);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'login')) {
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
				$user = $role == 'siswa' ? $siswaModel->find($data['username']) : $petugasModel->find($data['username']);

				$this->session->set([
					'login' => true,
					'user' => [
						'username' => $role == 'siswa' ? $user->nisn : $user->username,
						// 'password' => $role == 'siswa' ? $user->nis : $user->password,
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
