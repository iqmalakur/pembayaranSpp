<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use App\Models\SppModel;

class Spp extends BaseController
{
	protected $model;
	protected $jurusan;

	public function __construct()
	{
		$this->model = new SppModel();

		$jurusanModel = new JurusanModel();
		$this->jurusan = $jurusanModel->findAll();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/spp');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Spp";
		$this->data['spp'] = $this->model->get();

		return view("spp/index", $this->data);
	}

	public function create()
	{
		if (!$this->session->login) {
			return redirect()->to('/spp');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Tambah data Spp";
		$this->data['jurusan'] = $this->jurusan;
		$this->data['spp'] = $this->model;
		$this->data["errors"] = $this->session->get('errors');

		return view("spp/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost(["kompetensi_keahlian", "nominal"]);

		if ($data['kompetensi_keahlian'] == 'null') {
			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menambahkan data!",
				'text' => "Silahkan isi Kompetensi Keahlian dengan benar!"
			]);
			return redirect()->to('/spp/add');
		}

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'spp')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/spp/add')->withInput();
		} else {
			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/spp");
		}
	}

	public function edit($id)
	{
		if (!$this->session->login) {
			return redirect()->to('/spp');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Ubah data Spp";
		$this->data['spp'] = $this->model->get($id);
		$this->data['jurusan'] = $this->jurusan;
		$this->data["errors"] = $this->session->get('errors');

		return view("spp/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost(["id_spp", "nominal"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'spp')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/spp/edit/' . $data["id_spp"])->withInput();
		} else {
			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/spp");
		}
	}

	public function delete($id)
	{
		$this->model->delete($id);

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to("/spp");
	}
}
