<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasModel;

class Petugas extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new PetugasModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Petugas";
		$this->data['petugas'] = $this->model->findAll();

		return view("petugas/index", $this->data);
	}

	public function create()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Tambah data Petugas";
		$this->data["errors"] = $this->session->get('errors');

		return view("petugas/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost(['username', 'password', 'nama_petugas', 'level']);
		$password = $this->request->getPost(['password', 'repeatPassword']);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'petugas')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/petugas/add')->withInput();
		} else {
			if ($this->model->find($data['username'])) {
				$this->session->setFlashdata('exists', true);
				return redirect()->to('/petugas/add')->withInput();
			}

			if ($password['password'] !== $password['repeatPassword']) {
				$this->session->setFlashdata('wrongPassword', true);
				return redirect()->to('/petugas/add')->withInput();
			}

			$data['password'] = password_hash($password['password'], PASSWORD_DEFAULT);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/petugas");
		}
	}

	public function edit($username)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		if ($username === 'admin' && $this->user->username !== 'admin') {
			return redirect()->to('/petugas');
		}

		$this->data['title'] = "Ubah data Petugas";
		$this->data['petugas'] = $this->model->find($username);
		$this->data["errors"] = $this->session->get('errors');

		return view("petugas/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost(['username', 'editPassword', 'nama_petugas', 'level']);
		$password = $this->request->getPost(['editPassword', 'repeatPassword']);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'editPetugas')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/petugas/edit/' . $data["username"])->withInput();
		} else {
			if ($password['editPassword'] != null) {
				if ($password['editPassword'] !== $password['repeatPassword']) {
					$this->session->setFlashdata('wrongPassword', true);
					return redirect()->to('/petugas/edit/' . $data['username'])->withInput();
				}

				$data['password'] = password_hash($password['editPassword'], PASSWORD_DEFAULT);
			}

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/petugas");
		}
	}

	public function delete($username)
	{
		$this->model->delete($username);

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to("/petugas");
	}
}
