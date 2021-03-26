<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembayaranModel;
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

		if (!$page = $this->request->getGet('page_petugas')) {
			$page = 1;
		}

		$this->data['title'] = "CRUD Data Petugas";
		$this->data['petugas'] = $this->model->orderBy('nama_petugas')->paginate(5, 'petugas');
		$this->data['count'] = $this->model->countAll();
		$this->data['pager'] = $this->model->pager;
		$this->data['number'] = 5 * ($page - 1);

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

		$this->data['title'] = "Tambah Data Petugas";
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

			// Kembali ke form tambah petugas dan mengirimkan input sebelumnya
			return redirect()->to('/petugas/add')->withInput();
		} else {
			// Cek apakah username telah terdaftar
			if ($this->model->find($data['username'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Username " . $data['username'] . " telah digunakan!"
				]);

				// Kembali ke form tambah petugas dan mengirimkan input sebelumnya
				return redirect()->to('/petugas/add')->withInput();
			}

			// Cek password
			if ($password['password'] !== $password['repeatPassword']) {
				$this->session->setFlashdata('wrongPassword', true);

				// Kembali ke form tambah petugas dan mengirimkan input sebelumnya
				return redirect()->to('/petugas/add')->withInput();
			}

			// Mengubah username menjadi lower case
			// Mengubah nama petugas menjadi huruf kapital
			// Men-enkripsi password
			$data['username'] = strtolower($data['username']);
			$data['nama_petugas'] = ucwords($data['nama_petugas']);
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

		// Cek apakah petugas yang akan diedit adalah super admin
		// Super admin hanya boleh diedit oleh super admin itu sendiri
		// Admin lain (selain super admin) hanya bisa mengedit dirinya sendiri dan petugas
		if ($username !== $this->user->username && $this->model->find($username)->level !== 'petugas' && $this->user->username !== 'admin') {
			return redirect()->to('/petugas');
		}

		$this->data['title'] = "Ubah Data Petugas";
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

			// Kembali ke form ubah petugas dan mengirimkan input sebelumnya
			return redirect()->to('/petugas/edit/' . $data["username"])->withInput();
		} else {
			// Cek apakah password akan diubah
			if ($password['editPassword'] != null) {
				if ($password['editPassword'] !== $password['repeatPassword']) {
					$this->session->setFlashdata('wrongPassword', true);

					// Kembali ke form ubah petugas dan mengirimkan input sebelumnya
					return redirect()->to('/petugas/edit/' . $data['username'])->withInput();
				}

				// Enkripsi Password
				$data['password'] = password_hash($password['editPassword'], PASSWORD_DEFAULT);
			}

			// Mengubah nama petugas menjadi huruf kapital
			$data['nama_petugas'] = ucwords($data['nama_petugas']);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/petugas");
		}
	}

	public function delete($username)
	{
		try {
			$this->model->delete($username);
		} catch (\Exception $e) {
			// Mengubah nama petugas pada pembayaran sebelum petugas dihapus
			$pembayaranModel = new PembayaranModel();

			$pembayaranModel->ubahPetugas($username);
			$this->model->delete($username);

			$this->session->setFlashdata('successInfo', 'Menghapus');

			return redirect()->to("/petugas");
		}

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to("/petugas");
	}
}
