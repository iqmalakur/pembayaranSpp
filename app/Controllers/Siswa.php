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

		$this->data['title'] = "Siswa";
		$this->data['siswa'] = $this->model->get();

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

		$this->data['title'] = "Tambah data Siswa";
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

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/siswa/add')->withInput();
		} else {
			if ($this->model->find($data['nisn'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "NISN " . $data['nisn'] . " telah digunakan!"
				]);
				return redirect()->to('/siswa/add')->withInput();
			}

			if ($this->model->cekNis($data['nis'])) {
				$this->session->setFlashdata('message', [
					'icon' => "error",
					'title' => "Tidak dapat menambahkan data!",
					'text' => "NIS " . $data['nis'] . " telah digunakan!"
				]);
				return redirect()->to('/siswa/add')->withInput();
			}

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

		$this->data['title'] = "Ubah data Siswa";
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
			'id_kelas', 'alamat', 'no_telp',
			'id_spp'
		]);

		helper(['form', 'url']);
		$validation = \Config\Services::validation();

		// Cek Validasi (Rules ada di app/Config/validation.php)
		if (!$validation->run($data, 'siswa')) {
			$this->session->setFlashdata('errors', $validation->getErrors());

			// Kembali ke halaman login dan mengirimkan input sebelumnya
			return redirect()->to('/siswa/edit/' . $data["nisn"])->withInput();
		} else {
			$data['id_spp'] = $this->model->find($data['nisn'])->id_spp;

			$this->model->save($data);

			$this->session->setFlashdata('successInfo', 'Mengubah');

			return redirect()->to("/siswa");
		}
	}

	public function delete($nisn)
	{
		$this->model->delete($nisn);

		$this->session->setFlashdata('successInfo', 'Menghapus');

		return redirect()->to("/siswa");
	}

	public function detail($nisn)
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'petugas') {
			return view('errors/html/error_404');
		}

		$this->data['siswa'] = $this->model->get($nisn);
		$this->data['title'] = $this->data['siswa']->nama;

		return view("siswa/detail", $this->data);
	}
}
