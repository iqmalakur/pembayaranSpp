<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\SppModel;

class Siswa extends BaseController
{
	protected $model;
	protected $kelasModel;
	protected $sppModel;

	public function __construct()
	{
		$this->model = new SiswaModel();
		$this->kelasModel = new KelasModel();
		$this->sppModel = new SppModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		if (!$page = $this->request->getGet('page_siswa')) {
			$page = 1;
		}

		$this->data['title'] = "CRUD Data Siswa";
		$this->data['siswa'] = $this->model->get();
		$this->data['count'] = $this->model->countAll();
		$this->data['pager'] = $this->model->pager;
		$this->data['number'] = $this->paginationLength * ($page - 1);

		return view("siswa/index", $this->data);
	}

	public function create()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Tambah Data Siswa";
		$this->data['kelas'] = $this->kelasModel->findAll();
		$this->data['spp'] = $this->sppModel->findAll();
		$this->data["errors"] = $this->session->get('errors');

		return view("siswa/create", $this->data);
	}

	public function save()
	{
		$data = $this->request->getPost([
			'nisn', 'nis', 'nama',
			'id_kelas', 'alamat', 'no_telp',
			'id_spp'
		]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'siswa')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke form tambah siswa dan mengirimkan input sebelumnya
			return redirect()->to('/siswa/add')->withInput();
		} else {
			// Cek apakah nisn telah terdaftar
			if ($this->model->find($data['nisn'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "NISN " . $data['nisn'] . " telah digunakan!"
				]);

				// Kembali ke form tambah siswa dan mengirimkan input sebelumnya
				return redirect()->to('/siswa/add')->withInput();
			}

			// Cek apakah nis telah terdaftar
			if ($this->model->cekNis($data['nis'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "NIS " . $data['nis'] . " telah digunakan!"
				]);

				// Kembali ke form tambah siswa dan mengirimkan input sebelumnya
				return redirect()->to('/siswa/add')->withInput();
			}

			// Format nama menjadi huruf kapital
			$data['nama'] = ucwords($data['nama']);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Menambahkan');

			return redirect()->to("/siswa");
		}
	}

	public function edit($nisn)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Ubah Data Siswa";
		$this->data['siswa'] = $this->model->get($nisn);
		$this->data['kelas'] = $this->kelasModel->findAll();
		$this->data['spp'] = $this->sppModel->find($this->data['siswa']->id_spp);
		$this->data["errors"] = $this->session->get('errors');

		return view("siswa/edit", $this->data);
	}

	public function update()
	{
		$data = $this->request->getPost([
			'nisn', 'nis', 'nama',
			'id_kelas', 'alamat', 'no_telp'
		]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'siswa')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke form edit siswa dan mengirimkan input sebelumnya
			return redirect()->to('/siswa/edit/' . $data["nisn"])->withInput();
		} else {
			// Data spp siswa
			$data['id_spp'] = $this->model->find($data['nisn'])->id_spp;

			// Format nama menjadi huruf kapital
			$data['nama'] = ucwords($data['nama']);

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/siswa");
		}
	}

	public function delete($nisn)
	{
		try {
			$this->model->delete($nisn);
		} catch (\Exception $e) {
			$siswa = $this->model->find($nisn)->nisn;

			$this->session->setFlashdata('message', [
				'icon' => "error",
				'title' => "Tidak dapat menghapus data!",
				'text' => "Siswa dengan NISN $siswa masih memiliki relasi data Pembayaran"
			]);

			return redirect()->to('/siswa');
		}

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to('/siswa');
	}

	public function detail($nisn)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] !== 'admin') {
			return view('errors/html/error_404');
		}

		$this->data['siswa'] = $this->model->get($nisn);
		$this->data['title'] = $this->data['siswa']->nama;

		return view("siswa/detail", $this->data);
	}
}
