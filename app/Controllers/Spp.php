<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SppModel;

class Spp extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new SppModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/spp');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "CRUD Data Spp";
		$this->data['spp'] = $this->model->findAll();

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

		$this->data['title'] = "Tambah Data Spp";
		$this->data['spp'] = $this->model;
		$this->data["errors"] = $this->session->get('errors');

		return view("spp/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost(["tahun", "nominal"]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'spp')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/spp/add')->withInput();
		} else {
			$data['tahun'] .= ('/' . $this->request->getPost('tahun2'));

			if ($this->model->cek($data['tahun'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "SPP untuk tahun ajaran {$data['tahun']} telah ada!"
				]);
				return redirect()->to('/spp/add')->withInput();
			}

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

		$this->data['title'] = "Ubah Data Spp";
		$this->data['spp'] = $this->model->find($id);
		$this->data["errors"] = $this->session->get('errors');

		return view("spp/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost(["id_spp", "tahun", "nominal"]);

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
