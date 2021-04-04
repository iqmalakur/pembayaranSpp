<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use App\Models\KelasModel;

class Kelas extends BaseController
{
	protected $model;
	protected $jurusan;

	public function __construct()
	{
		$this->model = new KelasModel();

		$jurusanModel = new JurusanModel();
		$this->jurusan = $jurusanModel->orderBy('nama_jurusan')->findAll();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		if (!$page = $this->request->getGet('page_kelas')) {
			$page = 1;
		}

		$this->data['title'] = "CRUD Data Kelas";
		$this->data['kelas'] = $this->model->get();
		$this->data['count'] = $this->model->countAll();
		$this->data['pager'] = $this->model->pager;
		$this->data['number'] = $this->paginationLength * ($page - 1);

		return view("kelas/index", $this->data);
	}

	public function create()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Tambah Data Kelas";
		$this->data['jurusan'] = $this->jurusan;
		$this->data["errors"] = $this->session->get('errors');

		return view("kelas/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost(["nama_kelas", "kompetensi_keahlian"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'kelas')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke form tambah kelas dan mengirimkan input sebelumnya
			return redirect()->to('/kelas/add')->withInput();
		} else {
			// Ubah nama kelas menjadi upper case
			$data['nama_kelas'] = strtoupper($data['nama_kelas']);

			// Cek apakah nama kelas telah terdaftar
			if ($this->model->cek($data['nama_kelas'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Kelas " . $data['nama_kelas'] . " telah ada!"
				]);

				// Kembali ke form tambah kelas dan mengirimkan input sebelumnya
				return redirect()->to('/kelas/add')->withInput();
			}

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/kelas");
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

		$this->data['title'] = "Ubah Data Kelas";
		$this->data['kelas'] = $this->model->get($id);
		$this->data['jurusan'] = $this->jurusan;
		$this->data["errors"] = $this->session->get('errors');

		return view("kelas/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost(["id_kelas", "nama_kelas", "kompetensi_keahlian"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'kelas')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke form edit kelas dan mengirimkan input sebelumnya
			return redirect()->to('/kelas/edit/' . $data["id_kelas"])->withInput();
		} else {
			// Ubah nama kelas menjadi upper case
			$data['nama_kelas'] = strtoupper($data['nama_kelas']);

			// Cek apakah nama kelas telah terdaftar
			// Dan cek apakah nama kelas tidak sama dengan data sebelumnya (diubah)
			if ($this->model->cek($data['nama_kelas']) && $data['nama_kelas'] !== $this->model->find($data['id_kelas'])->nama_kelas) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "Kelas " . $data['nama_kelas'] . " telah ada!"
				]);

				// Kembali ke form edit kelas dan mengirimkan input sebelumnya
				return redirect()->to('/kelas/edit/' . $data['id_kelas'])->withInput();
			}

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/kelas");
		}
	}

	public function delete($id)
	{
		if ($this->model->cekHapus($id)) {
			$kelas = $this->model->find($id)->nama_kelas;

			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menghapus data!",
				'text' => "Kelas $kelas masih memiliki relasi data  Siswa"
			]);
		} else {
			$this->model->delete($id);

			$this->session->setFlashdata('successInfo', 'Menghapus');
		}

		return redirect()->to('/kelas');
	}
}
