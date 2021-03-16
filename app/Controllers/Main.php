<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Main extends BaseController
{
	protected $siswaModel;

	public function __construct()
	{
		$this->siswaModel = new SiswaModel();
	}

	public function index()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		$this->data['title'] = "dashboard";
		$this->data['loginStatus'] = $this->session->get('success');

		return view("main/index", $this->data);
	}

	public function payment()
	{
		if (!$this->session->login) {
			return redirect()->to('/login');
		}

		if ($this->session->user['role'] === 'siswa') {
			return view('errors/html/error_404');
		}

		$this->data['title'] = "Pembayaran Spp";
		$this->data['bulan'] = date('M');
		$this->data['siswa'] = $this->siswaModel->get();

		return view("main/payment", $this->data);
	}

	public function pay()
	{

		// Proses Pembayaran
	}

	public function report($data)
	{
		// Generate Laporan
	}

	public function receipt($data)
	{
		echo "Kuitansi";
		if (!$this->session->login) {
			return redirect()->to('/login');
		}
		// Kuitansi
	}

	public function ajaxPembayaran()
	{
		$keyword = $this->request->getPost("keyword");
		return view('ajax/pembayaran', ['siswa' => $this->siswaModel->searchAjax($keyword)]);
	}

	public function getSiswa()
	{
		$siswa = $this->siswaModel->get($this->request->getPost("nisn"));
		return "$siswa->nisn,$siswa->nama - $siswa->nama_kelas,$siswa->id_spp,$siswa->tahun,$siswa->nominal";
	}
}
