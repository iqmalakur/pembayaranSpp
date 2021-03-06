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

		if (!$page = $this->request->getGet('page_spp')) {
			$page = 1;
		}

		$this->data['title'] = "CRUD Data Spp";
		$this->data['spp'] = $this->model->orderBy('tahun_ajaran', 'DESC')->paginate($this->paginationLength, 'spp');
		$this->data['count'] = $this->model->countAll();
		$this->data['pager'] = $this->model->pager;
		$this->data['number'] = $this->paginationLength * ($page - 1);

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

			// Kembali ke form tambah spp dan mengirimkan input sebelumnya
			return redirect()->to('/spp/add')->withInput();
		} else {
			// Membuat format tahun tahun ajaran dari input tahun dan tahun2
			$data['tahun_ajaran'] = $this->request->getPost('tahun') . '/' . $this->request->getPost('tahun2');

			// Cek apakah tahun tahun ajaran telah terdaftar
			if ($this->model->cek($data['tahun_ajaran'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "SPP untuk tahun ajaran {$data['tahun_ajaran']} telah ada!"
				]);

				// Kembali ke form tambah spp dan mengirimkan input sebelumnya
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
		$data['tahun_ajaran'] = $data['tahun'];

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'spp')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke form edit spp dan mengirimkan input sebelumnya
			return redirect()->to('/spp/edit/' . $data["id_spp"])->withInput();
		} else {
			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/spp");
		}
	}

	public function delete($id)
	{
		if ($this->model->cekHapus($id)) {
			$spp = $this->model->find($id)->tahun_ajaran;

			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menghapus data!",
				'text' => "Spp untuk tahun ajaran $spp masih memiliki relasi data Siswa dan Pembayaran"
			]);
		} else {
			$this->model->delete($id);

			$this->session->setFlashdata('successInfo', 'Menghapus');
		}

		return redirect()->to('/spp');
	}
}
