<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;

class Jurusan extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new JurusanModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "CRUD Data Jurusan";
		$this->data['jurusan'] = $this->model->findAll();

		return view("jurusan/index", $this->data);
	}

	public function create()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Tambah Data Jurusan";
		$this->data["errors"] = $this->session->get('errors');

		return view("jurusan/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost(["nama_jurusan", "alias"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'jurusan')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/jurusan/add')->withInput();
		} else {
			if ($this->model->cek($data['nama_jurusan'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Jurusan " . $data['nama_jurusan'] . " telah ada!"
				]);
				return redirect()->to('/jurusan/add')->withInput();
			}

			$data['nama_jurusan'] = preg_replace("/Dan/", "dan", ucwords($data['nama_jurusan']));
			$data['alias'] = strtoupper($data['alias']);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/jurusan");
		}
	}

	public function edit($id)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Ubah Data Jurusan";
		$this->data['jurusan'] = $this->model->find($id);
		$this->data["errors"] = $this->session->get('errors');

		return view("jurusan/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost(["id_jurusan", "nama_jurusan", "alias"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'jurusan')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/jurusan/edit/' . $data["id_jurusan"])->withInput();
		} else {
			if ($this->model->cek($data['nama_jurusan']) && $data['nama_jurusan'] !== $this->model->find($data['id_jurusan'])->nama_jurusan) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Jurusan " . $data['nama_jurusan'] . " telah ada!"
				]);
				return redirect()->to('/jurusan/edit/' . $data['id_jurusan'])->withInput();
			}

			$data['nama_jurusan'] = preg_replace("/Dan/", "dan", ucwords($data['nama_jurusan']));
			$data['alias'] = strtoupper($data['alias']);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/jurusan");
		}
	}

	public function delete($id)
	{
		try {
			$this->model->delete($id);
		} catch (\Exception $e) {
			$jurusan = $this->model->find($id)->nama_jurusan;

			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menghapus data!",
				'text' => "Kompetensi Keahlian $jurusan masih memiliki relasi data Kelas"
			]);

			return redirect()->to("/jurusan");
		}

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to("/jurusan");
	}
}
